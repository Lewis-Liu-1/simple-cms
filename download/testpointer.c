#include <stdio.h>

int evaluate(char * c)
{
	printf("%s\n",c);
}

int main()
{
	int i=0x30;
	int *y;
	y=&i;
	evaluate((char*)y);
}
