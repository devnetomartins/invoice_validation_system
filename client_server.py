from ftplib import FTP

def verifica_dir(dir_name, ftp):
	if dir_name in [name for name, data in list(ftp.mlsd())]:
		print('existe')
	else:
		ftp.mkd(dir_name)
		print('criou diretorio')

ftp = FTP("107.180.51.34")
ftp.login('envio@certificados.sapucaia.com','teste12345')
ftp.cwd("backup")
print("File List:")
files = ftp.dir()
print(files)
#cria a pasta
verifica_dir('2018', ftp)

files = ftp.dir()

print(files)