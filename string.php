<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<?php

$data = "R2A|I|N|2100|mRVR10A|I|N|2100|mRVR10M|I|N|2100|mRVR10X|I|N|2100|mRVR10T|I|N|-1|RawMOR|R|N|8299.00|mMOR|R|N|8000.00|mMOR1A|I|N|8000|mMOR2A|I|N|8000|mMOR10A|I|N|8000|mMOR10M|I|N|8000|mMOR10X|I|N|9000|mVIS1K|R|N|1978.00|mRawVIS|R|N|8299.00|mVIS|R|N|8000.00|mVIS1A|I|N|8000|mVIS2A|I|N|8000|mVIS10A|I|N|6000|mVIS10M|I|N|8000|mVIS10X|I|N|9000|mBL|R|N|3008.00|cdm2BL1A|R|N|3028.25|cdm2BL2A|R|N|3050.75|cdm2LIGHTS|R|N|0.00|%EDGELIGHTS|R|N|0.00|%CENTERLIGHTS|R|N|0.00|%1|49809|14672281831|49810|14672281841|59658|1467228183|W|I|N|2100|mRVR10A|I|N|2100|mRVR10M|I|N|2100|mRVR10X|I|N|2100|mRVR10T|I|N|-1|RawMOR|R|N|8299.00|mMOR|R|N|8000.00|mMOR1A|I|N|8000|mMOR2A|I|N|8000|mMOR10A|I|N|8000|mMOR10M|I|N|8000|mMOR10X|I|N|9000|mVIS1K|R|N|1978.00|mRawVIS|R|N|8299.00|mVIS|R|N|8000.00|mVIS1A|I|N|8000|mVIS2A|I|N|8000|mVIS10A|I|N|7000|mVIS10M|I|N|8000|mVIS10X|I|N|9000|mBL|R|N|3008.00|cdm2BL1A|R|N|3028.25|cdm2BL2A|R|N|3050.75|cdm2LIGHTS|R|N|0.00|%EDGELIGHTS|R|N|0.00|%CENTERLIGHTS|R|N|0.00|%1|49809|14672281831|49810|14672281841|59658|1467228183|W";
$procuravis10aesq = strstr($data, "VIS10A");
//echo $procuravis10aesq;
$procuravis10adir = strstr($procuravis10aesq, "VIS10M", true);
//echo $procuravis10adir;
$procuravaloresq = strstr($procuravis10adir, "N");
//echo $procuravaloresq;

function soNumero($str) {
	return
	preg_replace("/[^0-9]/", "", $str);
}

$valorfinal = soNumero($procuravaloresq);
echo $valorfinal;
//$procuravalordir = strstr($procuravaloresq, "m", true);
//echo $procuravalordir;
//$tirabarra = str_replace("|", "", $procuravalordir);
//echo $tirabarra;


?>
</body>
</html>