#include <stdio.h>
#include <stdlib.h>
#include <string.h>

int main()
{
	char filename[50];
	char ch;
	FILE *file;
	printf("Please input your file name:");
	scanf("%s",filename);

	file=fopen(filename,"r");
	if (file==NULL)
	{
		printf("FILE not exist,goodbye\n");
		exit(1);
	}

	while(fread(&ch,sizeof(char),1,file))
	{
		printf("%c",ch);
	}
	fclose(file);

}
