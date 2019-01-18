<?php
	$url   =   trim($url);
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_HEADER,0);//启用时会将头文件的信息作为数据流输出。
	curl_setopt($ch,CURLOPT_TIMEOUT,60);//允许 cURL 函数执行的最长秒数。
	curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 60 );//在尝试连接时等待的秒数。设置为0，则无限等待。
	curl_setopt($ch,CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; zh-CN; rv:1.9.2.24) Gecko/20111103 Firefox/3.6.24");
	curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);//TRUE 将curl_exec()获取的信息以字符串返回，而不是直接输出。

	$content = curl_exec($ch);

	if ( $_GET[''] == 1 )
	{
		$info  = curl_getinfo($ch);// 获取一个cURL连接资源句柄的信息
		$errno = curl_errno($ch);
		$error = curl_error($ch);
		P($info);
		P($errno);
		P($error);
	}

	//CURLINFO_EFFECTIVE_URL - 最后一个有效的URL地址
	//CURLINFO_HTTP_CODE - 最后一个收到的HTTP代码
	//CURLINFO_FILETIME - 远程获取文档的时间，如果无法获取，则返回值为“-1”
	//CURLINFO_TOTAL_TIME - 最后一次传输所消耗的时间
	//CURLINFO_NAMELOOKUP_TIME - 名称解析所消耗的时间
	//CURLINFO_CONNECT_TIME - 建立连接所消耗的时间
	//CURLINFO_PRETRANSFER_TIME - 从建立连接到准备传输所使用的时间
	//CURLINFO_STARTTRANSFER_TIME - 从建立连接到传输开始所使用的时间
	//CURLINFO_REDIRECT_TIME - 在事务传输开始前重定向所使用的时间
	//CURLINFO_SIZE_UPLOAD - 以字节为单位返回上传数据量的总值
	//CURLINFO_SIZE_DOWNLOAD - 以字节为单位返回下载数据量的总值
	//CURLINFO_SPEED_DOWNLOAD - 平均下载速度
	//CURLINFO_SPEED_UPLOAD - 平均上传速度
	//CURLINFO_HEADER_SIZE - header部分的大小
	//CURLINFO_HEADER_OUT - 发送请求的字符串
	//CURLINFO_REQUEST_SIZE - 在HTTP请求中有问题的请求的大小
	//CURLINFO_SSL_VERIFYRESULT - 通过设置CURLOPT_SSL_VERIFYPEER返回的SSL证书验证请求的结果
	//CURLINFO_CONTENT_LENGTH_DOWNLOAD - 从Content-Length: field中读取的下载内容长度
	//CURLINFO_CONTENT_LENGTH_UPLOAD - 上传内容大小的说明
	//CURLINFO_CONTENT_TYPE - 下载内容的Content-Type:值，NULL表示服务器没有发送有效的Content-Type: header

	curl_close($ch);

	echo $content;
?>
