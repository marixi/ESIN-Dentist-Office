$current_dir = "$PWD"
$html_dir = "$current_dir\html"
$container_name = "php"

docker run -d -p 8080:8080 -it --name=${container_name} -v ${html_dir}:/var/www/html quay.io/vesica/php73:dev
