<?
require_once('../../NOLOH/NOLOH.php');



class QueueExample extends WebPage
{
	private $iframeContainer;

        function QueueExample()
        {
                parent::WebPage('Queue Broken!');
                ClientScript::AddSource("./flowplayer-3.2.4.min.js", false);
                ClientScript::AddSource("./flowplayer.controls-3.0.2.js", false);
                $this->BackColor = '#FFFFFF';


                $this->iframeContainer = new IFrame ( "example.html" , 320 , 0 , 400 , 255*3 );
		$this->iframeContainer->CSSBorder = "1px solid #000000";
		$this->Controls->Add($this->iframeContainer);	



	for ($i=0;$i<3;$i++) 
	{
                $mediaPanel = new Panel(0,248*$i,"320","240");
		$mediaPanel->CSSBackgroundColor = "#FF3000";
		$mediaPanel->Click = new ServerEvent($this,"addSWF",$mediaPanel);
		$this->Controls->Add($mediaPanel);	
	}




	}


	function addSWF($panel) 
	{

                ClientScript::RaceQueue($panel,
                                        'flowplayer', 
                                        '$f',
                                        Array($panel->Id,"flow.swf")
					);


 	        ClientScript::RaceQueue($this,
                                       'flowplayer',
                                       '$f("' . $panel->Id . '").play',
                                       Array('http://e1h13.simplecdn.net/flowplayer/flowplayer.flv'));

	}

	

}





?>
