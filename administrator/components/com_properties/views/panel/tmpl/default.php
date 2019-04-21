<?php
/**
 * @version		$Id: properties.php 1 2006-2016 este8an $
 * @package		Joomla.Administrator
 * @subpackage	com_properties
 * @copyright	Copyright (C) 2006 - 2016 Fabio Esteban Uzeltinger.
 * @email		fabiouz@gmail.com
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
// Disallow direct access to this file
defined('_JEXEC') or die('Restricted access');
$Version='5.20120708';
?>
<div class="row-fluid">


<?php if (!empty( $this->sidebar)) : ?>
	<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
	</div>
	<div id="j-main-container" class="span10">
<?php else : ?>
	<div id="j-main-container">
<?php endif;?>	






	<div class="row-fluid">
		<div class="well well-small">
            <h2 class="module-title nav-header">More Visited</h2>            
            <div class="row-striped">
            
            
<?php
//print_r($this->morevisited);

foreach($this->morevisited as $masvistos)
	{     
	
	       
?>            
			
            <div class="row-fluid">
				<div class="span9">
					<a title="" class="btn btn-micro disabled jgrid hasTooltip" data-original-title="Publicado"><i class="icon-publish"></i></a>					
					<strong class="row-title"><a href=""><?php echo $masvistos->name;?></a></strong>
					<small title="" class="hasTooltip" data-original-title="Creado por">
						<?php echo $masvistos->hits;?>
                    </small>
                    <br />
                   <div style="padding-left:40px;"><?php echo $this->getAgentName($masvistos->agent_id);?></div>
				</div>
				<div class="span3">
					<span class="small"><i class="icon-calendar"></i><?php echo $masvistos->refresh_time;?></span>
				</div>
			</div>
<?php
	}
?>                    
                    
			</div>
			</div>		
		</div>
        
        


    </div>




		 
        


</div>	<!--	row-fluid	--> 

