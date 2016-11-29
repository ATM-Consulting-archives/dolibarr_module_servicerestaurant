default_folder=$(pwd)							# On garde le chemin vers le répertoire contenant le module default
cd ..											# On remonte d'un cran

new_module=$1
new_module_number=$2
new_module_min=`echo $new_module | tr '[:upper:]' '[:lower:]'`

cp -R $default_folder $new_module_min			# On copie le répertoire default dans le répertoire cible
cd $new_module_min								# On se place dans le répertoire cible

rm -rf .git
rm -rf .settings
rm .project
rm new_module.sh

for fic in `find . -iname "*MyModule*" `
do
	# Renommage des variables dans les fichiers
	sed -i 's/MyModule/'$new_module'/g' $fic
	sed -i 's/mymodule/'$new_module_min'/g' $fic
	sed -i 's/100000/'$new_module_number'/g' $fic
	
	# Renommage des fichiers
	OLDNAME=`echo $fic`
	NEWNAME=`echo $fic | sed 's/MyModule/'$new_module'/g'`
	NEWNAME=`echo $NEWNAME | sed 's/mymodule/'$new_module_min'/g'`
	mv $OLDNAME $NEWNAME
done

git init

echo "Nouveau module $new_module préparé. Merci de supprimer le répertoire .git"
