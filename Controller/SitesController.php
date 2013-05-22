<?php
class SitesController extends AppController
{
	var $name = 'Sites';
	var $helpers = array('Html', 'Form');
	var $components = array('Auth');
	var $uses = array('Site','User','Message');

	function admin_siteconfig()
    {
		
		
		if (!empty($this->data))
		{
			//echo '<pre>';print_r($this->data);die;
			$site_data = $this->Site->find('list',array('conditions'=>array('Site.status'=>'1'),'fields'=>array('Site.title','Site.value')));
			
			foreach($this->data['Site'] as $k =>$v)
			{
				
				if($k=='fbimage_file')
				{
					if($v['error']==0)
					{
						@unlink(WWW_ROOT."img/site_config/".$site_data['fbimage']);
						move_uploaded_file($v['tmp_name'],WWW_ROOT."img/site_config/".$v['name']);
						$value=$v['name'];
						//print_r($value);die;
					}
					else
						$value=$site_data['fbimage'];
					$k='fbimage';
						
				}elseif($k=='twimage_file')
				{
					if($v['error']==0)
					{
						@unlink(WWW_ROOT."img/site_config/".$site_data['twimage']);
						move_uploaded_file($v['tmp_name'],WWW_ROOT."img/site_config/".$v['name']);
						$value=$v['name'];
					}
					else
						$value=$site_data['twimage'];
					$k='twimage';
						
				}elseif($k=='siteimage_file')
				{
					if($v['error']==0)
					{
						@unlink(WWW_ROOT."img/site_config/".$site_data['siteimage']);
						move_uploaded_file($v['tmp_name'],WWW_ROOT."img/site_config/".$v['name']);
						$value=$v['name'];
						
					}
					else
						$value=$site_data['siteimage'];
					
					$k='siteimage';
						
				}
				elseif($k=='limage_file')
				{
					if($v['error']==0)
					{
						@unlink(WWW_ROOT."img/site_config/".$site_data['limage']);
						move_uploaded_file($v['tmp_name'],WWW_ROOT."img/site_config/".$v['name']);
						$value=$v['name'];
					}
					else
						$value=$site_data['limage'];
					$k='limage';
						
				}
				elseif($k=='youtubeimage_file')
				{
					if($v['error']==0)
					{
						@unlink(WWW_ROOT."img/site_config/".$site_data['youtubeimage']);
						move_uploaded_file($v['tmp_name'],WWW_ROOT."img/site_config/".$v['name']);
						$value=$v['name'];
					}
					else
						$value=$site_data['youtubeimage'];
					$k='youtubeimage';
						
				}
				
				else
				{
					$value=$v;
					
				}
				
				
			

			
				$sql="update sites set value='".addslashes($value)."' where title='".$k."'";
				
				$this->Site->query($sql);
				
				if($k=='adminemail')
				{
					$sql="update users set emailId='".$v."' where id=1";
					$this->Site->query($sql);
				}
				if($k=='adminname')
				{
					$sql="update users set firstName='".$v."' where id=1";
					$this->Site->query($sql);
				}
				$this->Session->delete('Site');
				
			}
			
			
			
			
			
			$this->Session->setFlash('Settings has been saved successfully');
			$this->redirect(array('action'=>'siteconfig'));
		
		}
		if (empty($this->data)) {
			
			$this->request->data['Site'] = $this->Site->find('list',array('fields'=>array('Site.title','Site.value'),'conditions'=>array('Site.status'=>'1')));
			
			
		}
		
		
	}
}
?>
