<head><?php echo $map['js']; ?></head>
<body> <div class="container"><h1><?php echo ''.$mapa['Nazev'].'' ?></h1>
    </div>
    <?php
    
    if($mapa['Aktivni']==0&&$mapa['Nazev']!=null)
    
{    echo $map['html']; }else{
    
    echo ' <div class="alert alert-danger" role="alert"><h2>Tato mapa není aktivní nebo neexistuje!</h2></div>';
}
; ?></body>