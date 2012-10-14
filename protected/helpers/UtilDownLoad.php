<?php
//文件下载类，以下调用示例代码
//$download = new download('php,exe,html', false);
//if (!$download->downloadfile($filename))
//{
//echo $download->geterrormsg();
//}

class UtilDownLoad
{
  public $debug = true;
  public $errormsg = '';
  public $Filter = array();
  public $filename = '';
  public $mineType = 'text/plain';
  public $xlq_filetype = array();


  function __construct($fileFilter = '', $isdebug = true)
  {
    $this->setFilter($fileFilter);
    $this->setdebug($isdebug);
    $this->setfiletype();
  }

  function setFilter($fileFilter)
  {
    if (empty($fileFilter)) return;
    $this->Filter = explode(',', strtolower($fileFilter));
  }
  function setdebug($debug)
  {
    $this->debug = $debug;
  }

  function setfilename($filename)
  {
    $this->filename = $filename;
  }

  function downloadfile($filename)
  {
    $this->setfilename($filename);
    if ($this->filecheck())
    {
      $fn = array_pop(explode('/', strtr($this->filename, '', '/')));
      header('Pragma: public');
      header('Expires: 0'); // set expiration time
      header('Cache-Component: must-revalidate, post-check=0, pre-check=0');
      header('Content-type:'.$this->mineType);
      header('Content-Length: '.filesize($this->filename));
      header('Content-Disposition: attachment; filename='.$fn);
      header('Content-Transfer-Encoding: binary');
      readfile($this->filename);
      return true;                                     
    }
    else                           
    {
      return false;
    }
  }
  function geterrormsg()
  {
    return $this->errormsg;
  }

  function filecheck()
  {
    $filename = $this->filename;
    if (file_exists($filename))
    {
      $filetype = strtolower(array_pop(explode('.', $filename)));
      if (in_array($filetype, $this->Filter))
      {
        $this->errormsg .= $filename.'不允许下载！';
        if ($this->debug) exit($filename.'不允许下载！');
        return false;
      }
      else
      {
        if (function_exists("mime_content_type"))
        {
          $this->mineType = mime_content_type($filename);
        }
        if (empty($this->mineType))
        {
          if (isset($this->xlq_filetype[$filetype])) $this->mineType = $this->
              xlq_filetype[$filetype];
        }
        if (!empty($this->mineType)) return true;
        else
        {
          $this->errormsg .= '获取'.$filename.'文件类型时候发生错误，或者不存在预定文件类型内';
          if ($this->debug) exit('获取文件类型出错');
          return false;
        }
      }
    }
    else
    {
      $this->errormsg .= $filename.'不存在!';
      if ($this->debug) exit($filename.'不存在!');
      return false;
    }
  }

  function setfiletype()
  {		
		$this->xlq_filetype = array(
			'ai'=>'application/postscript',
			'aif'=>'audio/x-aiff',
			'aifc'=>'audio/x-aiff',
			'aiff'=>'audio/x-aiff',
			'asc'=>'text/plain',
			'au'=>'audio/basic',
			'avi'=>'video/x-msvideo',
			'bcpio'=>'application/x-bcpio',
			'bin'=>'application/octet-stream',
			'bmp'=>'image/bmp',
			'c'=>'text/plain',
			'cc'=>'text/plain',
			'ccad'=>'application/clariscad',
			'cdf'=>'application/x-netcdf',
			'chm'=>'application/octet-stream',
			'class'=>'application/octet-stream',
			'cpio'=>'application/x-cpio',
			'cpt'=>'application/mac-compactpro',
			'csh'=>'application/x-csh',
			'css'=>'text/css',
			'dcr'=>'application/x-director',
			'dir'=>'application/x-director',
			'dms'=>'application/octet-stream',
			'doc'=>'application/msword',
			'drw'=>'application/drafting',
			'dvi'=>'application/x-dvi',
			'dwg'=>'application/acad',
			'dxf'=>'application/dxf',
			'dxr'=>'application/x-director',
			'eps'=>'application/postscript',
			'es' =>'application/postsrcipt',
			'etx'=>'text/x-setext',
			'exe'=>'application/octet-stream',
			'ez'=>'application/andrew-inset',
			'f'=>'text/plain',
			'f90'=>'text/plain',
			'fli'=>'video/x-fli',
			'flv'=>'video/x-flv',
			'gif'=>'image/gif',
			'gtar'=>'application/x-gtar',
			'gz'=>'application/x-gzip',
			'h'=>'text/plain',
			'hdf'=>'application/x-hdf',
			'hh'=>'text/plain',
			'hqx'=>'application/mac-binhex40',
			'htm'=>'text/html',
			'html'=>'text/html',
			'ice'=>'x-conference/x-cooltalk',
			'ief'=>'image/ief',
			'iges'=>'model/iges',
			'igs'=>'model/iges',
			'ips'=>'application/x-ipscript',
			'ipx'=>'application/x-ipix',
			'jpe'=>'image/jpeg',
			'jpeg'=>'image/jpeg',
			'jpg'=>'image/jpeg',
			'js'=>'application/x-javascript',
			'kar'=>'audio/midi',
			'latex'=>'application/x-latex',
			'lha'=>'application/octet-stream',
			'lsp'=>'application/x-lisp',
			'lzh'=>'application/octet-stream',
			'm'=>'text/plain',
			'man'=>'application/x-troff-man',
			'me'=>'application/x-troff-me',
			'mesh'=>'model/mesh',
			'mid'=>'audio/midi',
			'midi'=>'audio/midi',
			'mif'=>'application/vnd.mif',
			'mime'=>'www/mime',
			'mov'=>'video/quicktime',
			'movie'=>'video/x-sgi-movie',
			'mp2'=>'audio/mpeg',
			'mp3'=>'audio/mpeg',
			'mpe'=>'video/mpeg',
			'mpeg'=>'video/mpeg',
			'mpg'=>'video/mpeg',
			'mpga'=>'audio/mpeg',
			'ms'=>'application/x-troff-ms',
			'msh'=>'model/mesh',
			'nc'=>'application/x-netcdf',
			'oda'=>'application/oda',
			'pbm'=>'image/x-portable-bitmap',
			'pdb'=>'chemical/x-pdb',
			'pdf'=>'application/pdf',
			'pgm'=>'image/x-portable-graymap',
			'pgn'=>'application/x-chess-pgn',
			'png'=>'image/png',
			'pnm'=>'image/x-portable-anymap',
			'pot'=>'application/mspowerpoint',
			'ppm'=>'image/x-portable-pixmap',
			'pps'=>'application/mspowerpoint',
			'ppt'=>'application/mspowerpoint',
			'ppz'=>'application/mspowerpoint',
			'pre'=>'application/x-freelance',
			'prt'=>'application/pro_eng',
			'ps'=>'application/postscript',
			'qt'=>'video/quicktime',
			'ra'=>'audio/x-realaudio',
			'ram'=>'audio/x-pn-realaudio',
			'rar'=>'application/octet-stream',
			'ras'=>'image/cmu-raster',
			'rgb'=>'image/x-rgb',
			'rm'=>'audio/x-pn-realaudio',
			'roff'=>'application/x-troff',
			'rpm'=>'audio/x-pn-realaudio-plugin',
			'rtf'=>'text/rtf',
			'rtx'=>'text/richtext',
			'scm'=>'application/x-lotusscreencam',
			'set'=>'application/set',
			'sgm'=>'text/sgml',
			'sgml'=>'text/sgml',   
			'sh'=>'application/x-sh',
			'shar'=>'application/x-shar',
			'silo'=>'model/mesh',
			'sit'=>'application/x-stuffit',
			'skd'=>'application/x-koan',
			'skm'=>'application/x-koan',
			'skp'=>'application/x-koan',
			'skt'=>'application/x-koan',
			'smi'=>'application/smil',
			'smil'=>'application/smil',
			'snd'=>'audio/basic',
			'sol'=>'application/solids',
			'spl'=>'application/x-futuresplash',
			'src'=>'application/x-wais-source',
			'step'=>'application/STEP',
			'stl'=>'application/SLA',
			'stp'=>'application/STEP',
			'sv4cpio'=>'application/x-sv4cpio',
			'sv4crc'=>'application/x-sv4crc',
			'swf'=>'application/x-shockwave-flash',
			't'=>'application/x-troff',
			'tar'=>'application/x-tar',
			'tcl'=>'application/x-tcl',
			'tex'=>'application/x-tex',
			'texi'=>'application/x-texinfo',
			'texinfo'=>'application/x-texinfo',
			'tif'=>'image/tiff',
			'tiff'=>'image/tiff',
			'tr'=>'application/x-troff',
			'ts'=>'application/x-troll-ts',
			'tsi'=>'audio/TSP-audio',
			'tsp'=>'application/dsptype',
			'tsv'=>'text/tab-separated-values',
			'txt'=>'text/plain',
			'unv'=>'application/i-deas',
			'ustar'=>'application/x-ustar',
			'vcd'=>'application/x-cdlink',
			'vda'=>'application/vda',
			'viv'=>'video/vnd.vivo',
			'vivo'=>'video/vnd.vivo',
			'vrml'=>'model/vrml',
			'wav'=>'audio/x-wav',
			'wrl'=>'model/vrml',
			'xbm'=>'image/x-xbitmap',
			'xlc'=>'application/vnd.ms-excel',
			'xll'=>'application/vnd.ms-excel',
			'xlm'=>'application/vnd.ms-excel',
			'xls'=>'application/vnd.ms-excel',
			'xlw'=>'application/vnd.ms-excel',
			'xml'=>'application/xml',
			'xpm'=>'image/x-xpixmap',
			'xwd'=>'image/x-xwindowdump',
			'xyz'=>'chemical/x-pdb',
			'zip'=>'application/zip',
		);
  }
  
  function getxlq_filetype($filetype)
  {
  	if (isset($this->xlq_filetype[$filetype]))
  		return $this->xlq_filetype[$filetype]; 
  	else 
  		$this->errormsg .= '获取'.$filetype.'文件类型时候发生错误，或者不存在预定文件类型内';
  		
  	return false;
  }
}

?>
