<?php
// /az/hprichbg/rb/PinkMullaMullaCravensPeak_ROW13205976948_1920x1080.jpg

// we use the regular expression to match the actual url

$save_folder='E:\sandip\bingimage\bing.com';



$url='https://www.bing.com';
$ch=curl_init();//initialize the curl resosurces
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);//due to https ,we use ssl secured 
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true); //instead of outputting the data to the screen,it saves the data inside of variable
$content=curl_exec($ch); //executes the curl handle 

//echo $content;

preg_match("!/az/hprichbg/rb/(.*?).jpg!",$content,$image_match); // $image_match for a match array
print_r($image_match);
$image_url=$url.$image_match[0];  //concatenated to stored full image url and zero is used to store the whole url

$image_name=$image_match[1].'.jpg'; //file name stored

$save_path=$save_folder.$image_name;
//echo $save_path;

$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,$image_url);
curl_setopt($ch,CURLOPT_HEADER,false); //we dont need any header info
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_BINARYTRANSFER,true); //imageurl works with image which is binary resources instead of text


$binary_data=curl_exec($ch);
curl_close($ch);
echo $binary_data;

if(file_exists($save_path)){
	unlink($save_path);
}
 $fh=fopen($save_path, 'x'); //create and open for writing  ,this tells the script to write the file to harddrive and not do anything else to it
 fwrite($fh, $binary_data);
 fclose($fh);

?>