<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Valle | Random Quote</title>
<link rel="stylesheet" href="style_quote.css" type="text/css"/>
</head>
<body>

<div class="note">
    <div class="note_corner">
    </div>
    <div class="note_top">
    </div> <!-- note-top ends -->
    <div class="note_middle">
        <!-- content goes here -->
            <br/>
            <?php
                $file = file("quotes.txt");
                $count = 0; // number of quotes
                $index = array(); // index: quote => line

                # scan file to count number of quotes and record where they appear
                # todo: this should be cached
                for ($i=0; $i<count($file); $i++) { // fill index
                    if (ereg("%%",$file[$i])) {
                        $count++;
                        $index[$count] = $i;
                    }
                }

                # decrement once since final %% marks end of last quote
                $count -= 1;

                if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] <= $count && $_GET['id']>0) {
                    $sel = $_GET['id'];
                } else {
                    $sel = rand(1, $count); // select random
                }

                echo '<div class="faded">';
                echo $sel."/".$count.' ';
                echo '</div>';
                echo '<span class="nav">';

                if ($sel>1) echo '<a href=\'?id=1\'>';
                echo '&lt;&lt; ';
                if ($sel>1) echo '</a> ';

                if ($sel>1) echo '<a href=\'?id='.($sel-1).'\'>';
                echo '&lt; ';
                if ($sel>1) echo '</a> ';

                echo '<a href=\'?id=random\'>random</a> ';

                if ($sel<$count) echo '<a href=\'?id='.($sel+1).'\'>';
                echo '&gt; ';
                if ($sel<$count) echo '</a> ';

                if ($sel<$count) echo '<a href=\'?id='.$count.'\'>';
                echo '&gt;&gt; ';
                if ($sel<$count) echo '</a> ';

                echo '</span><br/>';
    
                $has_attribution = False;
                for ($i=$index[$sel]+1; $i<$index[$sel+1]; $i++) {
                    $line = $file[$i];
                    if (preg_match('/^    --/',$line)) { 
                        echo '<span class="nav2">';
                        $has_attribution = True;
                    }
                    echo $line."<br/>";
                }
                if ($has_attribution) {
                    echo '</span>';
                }
                
            ?>
            <br/><br/>
    </div> <!-- note-middle ends -->
    <div class="note_bottom">
    </div> <!-- note-bottom ends -->
</div> <!-- note ends -->

</body>
</html>
