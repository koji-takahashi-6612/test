so cute
so fat

this cat can speak so fast
so, we call that scat

git add cat.txt

aaaaadfafda
## あああああ
echo "色変"
## うおおおおお  


cat ${IMAGE_LIST}
echo -n "are you sure you want to register above image(s)? (yes / no) : "
read ANSWER

if [ ${ANSWER} == "yes" ]; then
        while read line
        do
                set -- ${line}
                IMGNAME=$1
                UUID=$2
                OSTYPE=$3
                FILE=$4
                OWNER=$5

                echo "create new image ${IMGNAME}"
                glance image-create --name=${IMGNAME} --container-format=ovf --disk-format=qcow2 --visibility=private --file ${FILE} --owner ${OWNER} --id ${UUID} --progress
                echo "set metadata of new image ${IMGNAME}"
                glance image-update ${UUID} --min-disk 50
                glance image-update ${UUID} --property "os_type=${OSTYPE}"
                glance image-update ${UUID} --property "hw_qemu_guest_agent=yes"
                glance image-update ${UUID} --property "bootable=true"
        done < $IMAGE_LIST
elif [ ${ANSWER} == "no" ]; then
        echo "operation stopped"
else
        echo "invalid input"
        exit 1
fi



