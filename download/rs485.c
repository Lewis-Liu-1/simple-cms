#include <linux/init.h>
#include <linux/module.h>

//for inb, outb functions 
#include <asm/io.h>        
#include <linux/serial.h>
#include <linux/serialP.h>
#include <linux/serial_reg.h>
#include <asm/serial.h>
#include <linux/types.h>
#include <linux/kdev_t.h>
#include <linux/fs.h>
#include <linux/cdev.h>

#define ser_dev 0x3f8

//disable interrupts, is missing from serial-reg.h 
#define UART_IER_DISABLE    0X00    
//disable fifo 
#define UART_FCR_DISABLE_FIFO    0X00    
#define LCR_ADDR  (UART_LCR_WLEN8 | UART_LCR_PARITY \ 
			| UART_LCR_SPAR)
#define LCR_DATA  (UART_LCR_WLEN8 | UART_LCR_PARITY \
			| UART_LCR_SPAR | UART_LCR_EPAR)
#define UART_FIFO_SETUP (UART_FCR_ENABLE_FIFO | \
	UART_FCR_CLEAR_RCVR | UART_FCR_CLEAR_XMIT | UART_FCR_TRIGGER_1)

#define uint32    __u32
#define uint16    __u16
#define uint8    __u8
#define sint32    __s32
#define sint16    __s16
#define sint8    __s8
#define byte     __u8

// Macros 
//------------------------
#define inportb(port) (uint)(inb(ser_dev+port))
#define outportb(port,value) outb(value,ser_dev+port)
#define setbit(port,bits) outportb(port,(inportb(port)|bits))
#define clrbit(port,bits) outportb(port,inportb(port) & ~bits)

#define send_byte(b) outportb(UART_TX,b)
#define set_addr_bit() setbit(UART_LCR,LCR_ADDR)
#define init_mode_addr() outportb(UART_LCR,LCR_ADDR)
#define init_mode_data() outportb(UART_LCR,LCR_DATA)
#define is_tx_line_empty() (sint16)(\
	(inportb(UART_LSR)&UART_LSR_TEMT)==UART_LSR_TEMT)? 1 : 0
#define enable_rx_interrupt() setbit(UART_IER,UART_IER_RDI)
#define disable_rx_interrupt() clrbit(UART_IER,UART_IER_RDI)
#define enable_tx_interrupt() setbit(UART_IER,UART_IER_THRI)
#define diable_tx_interrupt() clrbit(UART_IER,UART_IER_THRI)
#define enable_rx_handshake() \
	do {outportb(UART_IER,UART_IER_RDI);\
    	setbit(UART_MCR,UART_MCR_OUT2);}\
	while(0)
#define request_to_send() setbit(UART_MCR,UART_MCR_RTS)
#define clr_request_to_send() clrbit(UART_MCR,UART_MCR_RTS)
#define diable_serial_interrupt() \
	do {outportb(UART_IER, 0);\
	 clr_request_to_send();}\
	while(0)
//------------------------

struct rs485_dev {
	struct semaphore sem;     // mutual exclusion semaphore     
	struct cdev my_dev;      // Char device structure        
};

struct rs485_dev * rs485_device;
static int rs485_major;

MODULE_LICENSE("Dual BSD/GPL");

static int rs485_init(void)
{
	int result, i;

	dev_t dev = MKDEV(0, 0);

	//
	// Register your major, and accept a dynamic number.
	
	if (rs485_major)
		result = register_chrdev_region(dev, 1, "net9");
	else {
		result = alloc_chrdev_region(&dev, 0, 1, "net9");
		//let kernel allocate a major for us
		rs485_major = MAJOR(dev);
		printk(KERN_ALERT "Our major %d\n",rs485_major);

	}
	if (result < 0)
		return result;

	printk(KERN_ALERT "net9 registered\n");
	return 0;
}

static void rs485_exit(void)
{
	int i;
	dev_t devno = MKDEV(rs485_major, 0);

	// cleanup_module is never called if registering failed 
	unregister_chrdev_region(devno, 1);

	printk(KERN_ALERT "net9 removed\n");
}

module_init(rs485_init);
module_exit(rs485_exit);

