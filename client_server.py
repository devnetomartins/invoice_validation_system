from ftplib import FTP
from datetime import datetime
import csv
import time
import os
import requests, json

url = 'http://localhost/invoice_validation_system/site/web/index.php?r=api%2Fdefault%2Fcreate'

def verifica_dir(dir_name, ftp):
	try:
		if dir_name in [name for name, data in list(ftp.mlsd())]:
			return 1
		else:
			ftp.mkd(dir_name)
			return 2

	except:
		return 3

def upload(sourceFilePath, name, ftp):
	try:
		if os.path.isfile(sourceFilePath):
			file = open(sourceFilePath, 'rb')
			ftp.storbinary('STOR %s' %name, file)
			file.close()
			print('ENVIADO')
			return True
	except Exception as ex:
		print(ex)

while True:

	try:
		print("conexao")
		#conexao
		ftp = FTP("107.180.51.34")
		ftp.login('envio@certificados.sapucaia.com','teste12345')
		print(ftp.pwd())
		ftp.quit()
		break
		ftp.cwd("backup")

		data = datetime.now()

		mes = data.month

		ano = data.year

		x = verifica_dir(str(ano), ftp)

		if x == 1 or x == 2:
			ftp.cwd(str(ano))
		else:
			continue

		#agora para a pasta de mes

		x = verifica_dir(str(mes), ftp)

		if x == 1 or x == 2:
			ftp.cwd(str(mes))
		else:
			continue

		#lendo o .csv para envio dos arquivos

		try:

			arq = open('ExpCertificado.csv')

		except:
			
			break

		lines = csv.reader(arq, delimiter=';')

		lista_arq = []

		lista_id = []

		lista_nome = []

		for k in lines:
			lista_id.append(k[0])

			lista_nome.append(k[2])

			lista_arq.append(k[1]+k[2])

		arq.close()

		tam = len(lista_arq)

		for k in range(0, tam, 1):

			while True:

				if upload(lista_arq[k], lista_nome[k], ftp):

					#requisição

					chave = lista_id[k]

					pdf = '/'+ str(mes) + '/' + str(ano)

					dados = data = {'chave' : chave, 'pdf': pdf}

					response = requests.post(url, data=dados)

					if response.status_code == 201:
						break

		ftp.quit()
		exit()

	except Exception as ex:

		print(ex)
		time.sleep(2)




