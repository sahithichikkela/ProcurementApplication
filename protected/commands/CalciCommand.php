<?php 
// include "/data/live/protected/models/Users.php";
class CalciCommand extends CConsoleCommand
{
   

    public function actionOpencalci(){
        // $model = new Users();
        echo 'Hello,' . exec("whoami")."!\nWelcome to command-line calci....\n";
        echo "Enter your options....\n";
        echo "1 - Addition\n2 - Subtraction\n3 - Multiplication\n4 - Division\nclose-cacli - To close app\n";
        $this->docalcs();
    }



    public function docalcs(){
        $opt = $this->readStdin();
        if(!in_array($opt,[1,2,3,4,'close-calci'])){
            echo "Enter a valid query bro...\n";
        }
        else{
            if($opt == 'close-calci'){
                echo exec('exit');
                return;
            }
            else if($opt == 1){
                $x = $this->readStdin("Enter the first number:");
                $y = $this->readStdin("Enter the second number:");
                $res = $x+$y;
                $cronttext = substr(explode('>', exec('crontab -l'))[0],17);
                $info = "Addition done by :".exec('whoami')." at ".exec('date');
                $ans = substr($cronttext,0,-2).'"\n:"'.$info;
                $com = " * * * * * echo '".$ans."' > /data/live/protected/commands/cronreport.txt";
                exec('echo "'.$com.'" | crontab -');


                // exec('echo " * * * * * ".$cronttext."\n".$info." > /data/live/protected/commands/cronreport.txt" | crontab -');
                echo "result = ".$res."\n";
            }
            else if($opt == 2){
                $x = $this->readStdin("Enter the first number:");
                $y = $this->readStdin("Enter the second number:");
                $res = $x-$y;
                $cronttext = substr(explode('>', exec('crontab -l'))[0],17);
                $info = "Substraction done by :".exec('whoami')." at ".exec('date');
                $ans = substr($cronttext,0,-2).'"\n:"'.$info;
                $com = " * * * * * echo '".$ans."' > /data/live/protected/commands/cronreport.txt";
                exec('echo "'.$com.'" | crontab -');
                echo "result = ".$res."\n";
            }
            else if($opt == 3){
                $x = $this->readStdin("Enter the first number:");
                $y = $this->readStdin("Enter the second number:");
                $res = $x*$y;
                $cronttext = substr(explode('>', exec('crontab -l'))[0],17);
                $info = "Multiplication done by :".exec('whoami')." at ".exec('date');
                $ans = substr($cronttext,0,-2).'"\n:"'.$info;
                $com = " * * * * * echo '".$ans."' >/data/live/protected/commands/cronreport.txt";
                exec('echo "'.$com.'" | crontab -');
                echo "result = ".$res."\n";
            }
            else if($opt == 4){
                $x = $this->readStdin("Enter the first number:");
                $y = $this->readStdin("Enter the second number:");
                $res = $x/$y;
                $cronttext = substr(explode('>', exec('crontab -l'))[0],17);
                $info = "Division done by :".exec('whoami')." at ".exec('date');
                $ans = substr($cronttext,0,-2).'"\n:"'.$info;
                $com = " * * * * * echo '".$ans."' > /data/live/protected/commands/cronreport.txt";
                exec('echo "'.$com.'" | crontab -');
                echo "result = ".$res."\n";
            }
        }
        $this->docalcs();
    }



    public function readStdin($message = 'Enter your option:?')
    {
        echo $message;

        $handle = fopen("php://stdin","r");
        $line = fgets($handle);

        return trim($line);
    }

    public function actionIndex($name){
        $model = new Users();
        echo $name;
    }
    

    // public function run($args=[]){
    //     print_r($args);
    // }
}