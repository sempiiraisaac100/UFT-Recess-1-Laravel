#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <unistd.h>
#include <sys/socket.h>
#include <sys/types.h>
#include <netinet/in.h>
#include <arpa/inet.h>
#include <ctype.h>
#include <time.h>



#define PORT 4444


void replaceAll(char buffer[], char password[],char location[],char user[]){
		FILE *fptr;
		FILE *ftemp;
		puts(location);
		fptr = fopen(location,"r");
		ftemp = fopen("replace.tmp","w");
		char oldword[1024];

		if(fptr == NULL || ftemp == NULL){
			puts("UNREABALE");
		}
		else{
			while(fgets(buffer,1024,fptr)!=NULL){
				int totalRead = strlen(buffer);
				buffer[totalRead - 1] = buffer[totalRead - 1] == '\n' ? '\0' : buffer[totalRead - 1];
				if(strstr(buffer,user)!=NULL){
					sprintf(oldword,"%s",buffer);
					break;
					}
			}
			rewind(fptr);
			puts(oldword);

			while(fgets(buffer,1024,fptr)!=NULL){
					char *pos, temp[1024];
					int index = 0;
					int owlen;
					owlen = strlen(oldword);

					while((pos = strstr(buffer,oldword)) != NULL){
						strcpy(temp,buffer);
						index = pos - buffer;
						buffer[index] = '\0';
						strcat(buffer,password);
						strcat(buffer,temp+index+owlen);
					}
					fputs(buffer,ftemp);

			}
			fclose(fptr);
			fclose(ftemp);
			remove(location);
			rename("replace.tmp",location);	
	    }

}
void checker(int newSocket,char location[],char buffer[],char district[],char status[]){
		FILE *fptr;
		char pitem[1024];
		int words = 0;
		char message[1024];
		int clients =0;
		int check;
		fptr = fopen(location,"r");
        
		if(fptr ==NULL){
			printf("file not found \n");
			if(strcmp(status,"ok")==0){
                sprintf(message,"THE ENROLLMENT FILE IS COMPLETE AND VALID");
				send(newSocket, message, sizeof(message),0);	
			}
		}
		else{
			//get the number of occurances of the item		
			while(fgets(pitem,1024,fptr)!=NULL){
				int totalRead = strlen(pitem);

				pitem[totalRead - 1] = pitem[totalRead - 1] == '\n' ? '\0' : pitem[totalRead - 1];

				if(strstr(pitem,buffer)!=NULL){
					words++;
					check =1;
				}

				clients++;

			}
			puts(status);
			if(strcmp(status,"ok")==0){
				puts("fish");
				if(check == 1){
					sprintf(message,"change");
					send(newSocket,message,sizeof(message),0);
					sprintf(message,"YOU HAVE A WRONG SIGNATURE AND %d OTHERS AGENTS",(clients-1));
					send(newSocket,message,sizeof(message),0);
				}
				else{		
					sprintf(message,"%d AGENT(S) HAVE WRONG SIGNATURES",clients);
					send(newSocket,message,sizeof(message),0);
				}
			}
		
			else{
				printf("%d\n",words);
				send(newSocket, &words, sizeof(int),0);
			
				rewind(fptr);

				while(fgets(pitem,1024,fptr)!=NULL){
					int totalRead = strlen(pitem);
					pitem[totalRead - 1] = pitem[totalRead - 1] == '\n' ? '\0' : pitem[totalRead - 1];
					if(strstr(pitem,buffer)!=NULL){
							send(newSocket,pitem,sizeof(pitem),0);			
					}

				}
			}
		}	
					
}
int splitter(char data[],char check[],char dis[]){
	char delim[] = ",";
	char *ptr = strtok(data, delim);  
	int i = 0;
	char *ptx[10];
	while(ptr!=NULL){                                
		ptx[i] = ptr;
		i++;
		ptr = strtok(NULL,delim);
	}
	if(i > 2){
		//check if recommender exists in file

		FILE *fptr;
		char pitem[1024];
		char location[1024];
		sprintf(location,"UFT/storage/app/recommender/%s.txt",dis);

		fptr = fopen(location,"r");
			if(fptr ==NULL){
				printf("file not found \n");
			}
			while(fgets(pitem,1024,fptr)!=NULL){
				int totalRead = strlen(pitem);

				pitem[totalRead - 1] = pitem[totalRead - 1] == '\n' ? '\0' : pitem[totalRead - 1];
				if(strstr(pitem,ptx[2])!=NULL){
					strcpy(check,"ok");
					break;

				}
			}
	}
    //if no recommender arguement supplied
	else{
	strcpy(check,"ok");
	}


	return 0;

}
int currdate(char timex[]){
    time_t t = time(NULL);
    struct tm *tm = localtime(&t);
    strftime(timex,1024,"%Y-%m-%d",tm);
	return 0;
}

int addmember(char arr[],char dis[],char dater[],char user[],char signchecker[]){
	char location[1024];
	if(strcmp(signchecker,"approve")==0){
		puts("fish");
		sprintf(location,"UFT/storage/app/enrollments/%s.sign",dis);
	}
	else{
	sprintf(location,"UFT/storage/app/enrollments/%s.txt",dis);
	sprintf(arr,"%s,%s,%s,%s",arr,user,dater,dis);
	}


	FILE *fp;
	   fp =fopen(location,"a"); 
	   fputs(arr,fp);
	   fputs("\n",fp);
	   fclose(fp);

	return 0;
}


//triming of the strings 
void ltrim(char str[])
{
        int i = 0, j = 0;
        char buf[1024];
        strcpy(buf, str);
        for(;str[i] == ' ';i++);

        for(;str[i] != '\0';i++,j++)
                buf[j] = str[i];
        buf[j] = '\0';
        strcpy(str, buf);
}

int main(){

	int sockfd, ret;
	 struct sockaddr_in serverAddr;

	int newSocket;
	struct sockaddr_in newAddr;
	socklen_t addr_size;

	
	pid_t childpid;

	sockfd = socket(AF_INET, SOCK_STREAM, 0);
	if(sockfd < 0){
		puts("[-]Error in connection.");
		exit(1);
	}
	puts("[+]Server Socket is created.");

	memset(&serverAddr, '\0', sizeof(serverAddr));
	serverAddr.sin_family = AF_INET;
	serverAddr.sin_port = htons(PORT);
	serverAddr.sin_addr.s_addr = inet_addr("127.0.0.1");

	ret = bind(sockfd, (struct sockaddr*)&serverAddr, sizeof(serverAddr));
	if(ret < 0){
		puts("[-]Error in binding.");
		exit(1);
	}
	printf("[+]Bind to port %d\n", 4444);

	if(listen(sockfd, 10) == 0){
		printf("[+]Listening....\n");
	}else{
		printf("[-]Error in binding.\n");
	}


	while(1){	
		newSocket = accept(sockfd, (struct sockaddr*)&newAddr, &addr_size);
		if(newSocket < 0){
			exit(1);
		}
		printf("Connection accepted from %s:%d\n", inet_ntoa(newAddr.sin_addr), ntohs(newAddr.sin_port));

		if((childpid = fork()) == 0){
			close(sockfd);

			while(1){
	            char buffer[1024];
				char district[1024];
				char password[10];
				char user[1024];
				char cdate[1024];
				currdate(cdate);
				recv(newSocket,buffer,1024,0);
                puts(buffer);
				if(strcmp(buffer, "Addmember") == 0){
					char signchecker[1024];
					recv(newSocket,district,1024,0);
					recv(newSocket,user,1024,0);
					recv(newSocket,buffer,1024,0);

					//variables to be used
					char test[1024];
					strcpy(test,buffer);
					char check[100] = "fail";

					if(strcmp(buffer,"file") ==0){
						bzero(buffer,sizeof(buffer));
						FILE *fp;
						int ch = 0;
						int words;
						char location[1024];
						sprintf(location,"UFT/storage/app/enrollments/%s.txt",district);
						fp =fopen(location,"a");
						recv(newSocket, &words, sizeof(int),0);				
						printf("%d\n",words);
						while(ch != words){
							recv(newSocket,buffer,1024,0);
							printf("%s",buffer);
							splitter(test,check,district);

							if(strcmp(check,"ok")==0){
								puts("file ok");
								addmember(buffer,district,cdate,user,signchecker);
								sprintf(buffer,"COMMAND SUCCESFUL");
								send(newSocket,buffer,sizeof(buffer),0);
								

							}
							else{
								puts("file failer");
								sprintf(buffer,"RECOMMENDER NOT FOUND IN DATABASE");
								send(newSocket,buffer,sizeof(buffer),0);

							}
							
							ch++;
							printf("%d\n",ch);
						}
						fclose(fp);

					}
					else{
						//splitting and checking the recommender
						splitter(test,check,district);

                        if(strcmp(check,"ok")==0){
							puts("add ok");
							addmember(buffer,district,cdate,user,signchecker);
							sprintf(buffer,"COMMAND SUCCESFUL");
							send(newSocket,buffer,sizeof(buffer),0);

						}
						else{
							puts("add failer");
							sprintf(buffer,"RECOMMENDER NOT FOUND IN DATABASE");
							send(newSocket,buffer,sizeof(buffer),0);

						}
						
					}
					bzero(buffer,sizeof(buffer));
					
				}
				else if(strcmp(buffer, "search") == 0){
					char location[1024];
					char status[1024];
					recv(newSocket,district,1024,0);
					recv(newSocket,buffer,1024,0);
					puts(district);
					puts(buffer);

				
					sprintf(location,"UFT/storage/app/search/enrollments/%s.txt",district);

					   //call the search module
					checker(newSocket,location,buffer,district,status);
					bzero(buffer,sizeof(buffer));

				}
				else if(strcmp(buffer, "check_status") == 0){
					bzero(buffer,sizeof(buffer));
					char status[1024];
					sprintf(status,"ok");
					char location[1024];
					recv(newSocket,district, sizeof(district),0);
					recv(newSocket, user, sizeof(user),0);
					sprintf(location,"UFT/storage/app/status/%s.txt",district);
					checker(newSocket,location,user,district,status);

					
                   bzero(buffer,sizeof(buffer));
				}
				else if(strcmp(buffer, "get_statement") == 0){
					char status[1024];
					recv(newSocket,district, sizeof(district),0);
					recv(newSocket, user, sizeof(user),0);

					char location[1024];
					sprintf(location,"UFT/storage/app/payments/%s.txt",district);
					//call the search module
				    checker(newSocket,location,user,district,status);
					bzero(buffer,sizeof(buffer));
				}
				else if(strcmp(buffer, "Approve") == 0){
					char signchecker[1024];
					strcpy(signchecker,"approve");
					char data[1024];
					recv(newSocket,user, sizeof(user),0);
					recv(newSocket,district, sizeof(district),0);
					recv(newSocket,password, sizeof(password),0);
					sprintf(data,"%s:%s",user,password);
					addmember(data,district,cdate,user,signchecker);

					bzero(buffer,sizeof(buffer));
				}
				
				else if(strcmp(buffer, "correct") == 0){
					bzero(buffer,sizeof(buffer));
				    recv(newSocket,user, sizeof(user),0);
					recv(newSocket,district, sizeof(district),0);
					recv(newSocket,password, sizeof(password),0);
			
					char location[1024];
					sprintf(location,"UFT/storage/app/enrollments/%s.sign",district);
          
		            //call to replaceAll module
					replaceAll(buffer,password,location,user);
					sprintf(buffer,"FILE RE-SIGN SUCCESSFULL");
					send(newSocket,buffer,sizeof(buffer),0);

					bzero(buffer,sizeof(buffer));
				}
				
				else if(strcmp(buffer, "exit") == 0){
					printf("Disconnected from %s:%d\n", inet_ntoa(newAddr.sin_addr), ntohs(newAddr.sin_port));
					break;
				}

			}
		}

	}

	close(newSocket);

	return 0;
}
