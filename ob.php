<?php

$file = null;
if (2 === count($argv)) {
  if (is_file($argv[1])) {
    $file = file_get_contents($argv[1]);
    if (false !== $file) {
      $content = "fclosefwritestream_get_meta_datatmpfileuri".$file;
      $key     = random_bytes(strlen($content));

      // encrypt content
      for ($index = 0; $index < strlen($content); $index++) {
        $content[$index] = chr((ord($content[$index])^ord($key[$index]))%256);
      }

      // convert content to hex string
      $temp    = $content;
      $content = "";
      for ($index = 0; $index < strlen($temp); $index++) {
        $content .= "\\x".bin2hex($temp[$index]);
      }

      // convert key to hex string
      $temp = $key;
      $key  = "";
      for ($index = 0; $index < strlen($temp); $index++) {
        $key .= "\\x".bin2hex($temp[$index]);
      }

      print("<?php \$a=\"\\x73\\x75\\x62\\x73\\x74\\x72\";\$b=\"\\x63\\x68".
            "\\x72\\x6f\\x72\\x64\\x73\\x74\\x72\\x6c\\x65\\x6e\";\$c=\"".
            $content."\";\$d=\"".$key."\";for(\$e=0;\$e<\$a(\$b,6,6)(\$c);".
            "\$e++){\$c[\$e]=\$a(\$b,0,3)((\$a(\$b,3,3)(\$c[\$e])^\$a(\$b,3,3)".
            "(\$d[\$e]))%256);}\$e=\$a(\$c,32,7)();\$f=\$a(\$c,12,20)(\$e);".
            "\$a(\$c,6,6)(\$e,\$a(\$c,42));include(\$f[\$a(\$c,39,3)]);".
            "\$a(\$c,0,6)(\$e);\n");
    }
  }
}
