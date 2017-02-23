<?php
function delete_img($img)
{
	unlink($img);
	// if(unlink(dirname(basename($img))))
	// {
	// 	echo ("Error deleting");
	// }
	// else
 //  	{
 //  		echo ("Deleted");
 //  	}
}
?>