TARGET = rs485

obj-m :=$(TARGET).o
#$(TARGET)-y := rs485.oreceive.o hello.o mybuffer.o

MDIR = drivers/misc

EXTRA_CFLAGS = -DEXPORT_SYMTAB
CURRENT = $(shell uname -r)
KDIR = /lib/modules/$(CURRENT)/build
PWD = $(shell pwd)
DEST = /lib/modules/$(CURRENT)/kernel/$(MDIR)

default:
	make -C $(KDIR) SUBDIRS=$(PWD) modules

#$(TARGET).o: $(OBJS)
#	$(LD) $(LD_RFLAG) -r -o $@ $(OBJS)

ifneq (,$(findstring 2.4.,$(CURRENT)))
install:
	su -c "cp -v $(TARGET).o $(DEST) && /sbin/depmod -a"
	su -c "rmmod $(TARGET)"
	su -c "modprobe $(TARGET)"
else
install:
	su -c "cp -v $(TARGET).ko $(DEST) && /sbin/depmod -a"
	su -c "rmmod $(TARGET)"
	su -c "modprobe $(TARGET)"
endif

clean:
	-rm -f *.o *.ko .*.cmd .*.flags *.mod.c

-include $(KDIR)/Ruless.make
