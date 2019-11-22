#!/bin/sh

URL='url zabix'
HEADER='Content-Type:application/json'
USER='"grafico"'
PASS='"*visualiza@2019*"'

autenticacao()
{
    JSON='
    {
        "jsonrpc": "2.0",
        "method": "user.login",
        "params": {
            "user": '$USER',
            "password": '$PASS'
        },
        "id": 0
    }
    '
    curl -s -X POST -H "$HEADER" -d "$JSON" "$URL" | cut -d '"' -f8
}
TOKEN=$(autenticacao)

host_get()
{
    JSON='
    {
    	"jsonrpc": "2.0",
    	"method": "host.get",
    	"params": {
		"search": {
		     "host": ["Filial8395"]
		 	 },
 		"startSearch": true,
                "searchByAny": true
   	},
    	"auth": "'$TOKEN'",
    	"id": 1
    }
    '
    curl -s -X POST -H "$HEADER" -d "$JSON" "$URL" | python -m json.tool | grep "hostid" | cut -d":" -f2 | sed 's/"//g' | sed 's/,//g' | sed -n '1p'
}
ID=$(host_get)

graph_get()
{
    JSON='
    {
    	"jsonrpc": "2.0",
    	"method": "graph.get",
    	"params": {
        	"output":  "extend",
        	"hostids": '$ID',
        	"sortfield": "name",
		"search": {
			"name": ["Latencia"]
			  },
		"startSearch": true,
		"searchByAny": true
	},
    	"auth": "'$TOKEN'",
    	"id": 1
    }
    '
    curl -s -X POST -H "$HEADER" -d "$JSON" "$URL" | python -m json.tool |grep graphid | cut -d":" -f2 | sed 's/"//g' | sed 's/,//g' | sed 's/ //g'
}
GRAFICO=$(graph_get)

#########################
# Variaveis de producao # 
#########################

DIR_IMAGENS=/var/www/html/analise #Diretorio que vai armazenar as imagens
NOME_IMAGEM=grafico #Nome das imagens a serem geradas
DIR_COOKIE=/tmp #Diretorio que vai armazenar o cookie
NOME_COOKIE=zabbix.cookie
ENDERECO='' #Url do Zabbix
USUARIO='grafico' # Usuario do Zabbix que tenha privilegio de visualizar todos os mapas
SENHA='**'  # Senha do usuario acima
CHART=2 # ID do tipo de grafico
ID=$GRAFICO # ID do grafico que sera gerada a imagem
PERIODO=7200 # Periodo (em segundos) que serao exibidos no grafico

######################################################################
# Logica do Script - Nao altere a menos que saiba o que esta fazendo #
######################################################################

# Gera o cookie
wget -q --save-cookies=$DIR_COOKIE\/$NOME_COOKIE -4 --keep-session-cookies 2> /dev/null -O - -S --post-data="name=

$USUARIO&password=$SENHA&enter=Sign in&autologin=1&request=" $ENDERECO\/index.php?login=1 > /dev/null

# Gera as imagens
wget -q -4 --load-cookies=$DIR_COOKIE\/$NOME_COOKIE -O $DIR_IMAGENS\/$NOME_IMAGEM.png "$ENDERECO/chart$CHART.php?graphid=$ID&period=$PERIODO"

# Remove o cookie
rm -rf $DIR_COOKIE/$NOME_COOKIE

