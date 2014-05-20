<?php echo base_url(); ?>


<div class="menup">
    <div id="menup">
         <? if($this->session->userdata('accesslevel') == 1){?>
        <a href="<?php echo base_url(); ?>physician" class="m_1"></a>
        <a href="<?php echo base_url(); ?>physician/referals" class="m_2"></a>
        <a href="<?php echo base_url(); ?>physician/mypatients" class="m_3"></a>
         <a href="<?php echo base_url(); ?>physician/download" class="m_4"></a>
        <a href="<?php echo base_url(); ?>physician/myinfo" class="m_5"></a>
        <a href="<?php echo base_url(); ?>user/logout" class="m_6"></a>
        <?}?>
        
        <? if($this->session->userdata('accesslevel') == 2){?>
        <a href="<?php echo base_url(); ?>physician" class="m_1"></a>
        <a href="<?php echo base_url(); ?>physician/referals" class="m_2"></a>
        <a href="<?php echo base_url(); ?>physician/mypatients" class="m_3"></a>
      <a href="<?php echo base_url(); ?>physician" class="m_4"></a>
       <a href="<?php echo base_url(); ?>physician" class="m_5"></a>
        <a href="<?php echo base_url(); ?>user/logout" class="m_6"></a>
        <?}?>
        
    </div>
</div>
