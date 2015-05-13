<?php /* Smarty version Smarty-3.1.14, created on 2015-05-04 10:22:01
         compiled from "/home2/amorales/public_html/backoffice/themes/default/template/controllers/products/attachments.tpl" */ ?>
<?php /*%%SmartyHeaderCode:126138588855478089dd0556-87524407%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b47df69e483c53ed069a71106e4a81426b98e319' => 
    array (
      0 => '/home2/amorales/public_html/backoffice/themes/default/template/controllers/products/attachments.tpl',
      1 => 1406318375,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '126138588855478089dd0556-87524407',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'obj' => 0,
    'id_lang' => 0,
    'languages' => 0,
    'attachment_name' => 0,
    'attachment_description' => 0,
    'PS_ATTACHMENT_MAXIMUM_SIZE' => 0,
    'attachment_uploader' => 0,
    'attach2' => 0,
    'attach' => 0,
    'attach1' => 0,
    'link' => 0,
    'iso_tiny_mce' => 0,
    'ad' => 0,
    'default_form_language' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5547808a07b6e1_40133657',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5547808a07b6e1_40133657')) {function content_5547808a07b6e1_40133657($_smarty_tpl) {?>

<?php if (isset($_smarty_tpl->tpl_vars['obj']->value->id)){?>
<div id="product-attachements" class="panel product-tab">
	<input type="hidden" name="submitted_tabs[]" value="Attachments" />
	<h3><?php echo smartyTranslate(array('s'=>'Attachment'),$_smarty_tpl);?>
</h3>

	<div class="form-group">
		<label class="control-label col-lg-3 required" for="attachment_name_<?php echo $_smarty_tpl->tpl_vars['id_lang']->value;?>
">
			<span class="label-tooltip" data-toggle="tooltip"
			title="<?php echo smartyTranslate(array('s'=>'Maximum 32 characters.'),$_smarty_tpl);?>
">
			<?php echo smartyTranslate(array('s'=>'Filename'),$_smarty_tpl);?>

			</span>
		</label>
		<div class="col-lg-9">
			<?php echo $_smarty_tpl->getSubTemplate ("controllers/products/input_text_lang.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('languages'=>$_smarty_tpl->tpl_vars['languages']->value,'input_value'=>$_smarty_tpl->tpl_vars['attachment_name']->value,'input_name'=>"attachment_name"), 0);?>

		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-lg-3" for="attachment_description_<?php echo $_smarty_tpl->tpl_vars['id_lang']->value;?>
">
			<?php echo smartyTranslate(array('s'=>'Description'),$_smarty_tpl);?>

		</label>
		<div class="col-lg-9">
			<?php echo $_smarty_tpl->getSubTemplate ("controllers/products/textarea_lang.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('languages'=>$_smarty_tpl->tpl_vars['languages']->value,'input_name'=>"attachment_description",'input_value'=>$_smarty_tpl->tpl_vars['attachment_description']->value), 0);?>

		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-lg-3" for="attachement_filename">
			<span class="label-tooltip" data-toggle="tooltip"
				title="<?php echo smartyTranslate(array('s'=>'Upload a file from your computer'),$_smarty_tpl);?>
 (<?php echo sprintf('%.2f',$_smarty_tpl->tpl_vars['PS_ATTACHMENT_MAXIMUM_SIZE']->value);?>
 <?php echo smartyTranslate(array('s'=>'MB max.'),$_smarty_tpl);?>
)">
				<?php echo smartyTranslate(array('s'=>'File'),$_smarty_tpl);?>

			</span>
		</label>
		<?php echo $_smarty_tpl->tpl_vars['attachment_uploader']->value;?>

	</div>

	<hr/>

	<div class="form-group">
		<div class="col-lg-9 col-lg-offset-3">
			<div class="row">
				<div class="col-lg-6">
					<p><?php echo smartyTranslate(array('s'=>'Available attachments:'),$_smarty_tpl);?>
</p>
					<select multiple id="selectAttachment2">
						<?php  $_smarty_tpl->tpl_vars['attach'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['attach']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['attach2']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['attach']->key => $_smarty_tpl->tpl_vars['attach']->value){
$_smarty_tpl->tpl_vars['attach']->_loop = true;
?>
							<option value="<?php echo $_smarty_tpl->tpl_vars['attach']->value['id_attachment'];?>
"><?php echo $_smarty_tpl->tpl_vars['attach']->value['name'];?>
</option>
						<?php } ?>
					</select>
					<a href="#" id="addAttachment" class="btn btn-default btn-block">
						<?php echo smartyTranslate(array('s'=>'Add'),$_smarty_tpl);?>

						<i class="icon-arrow-right"></i>
					</a>
				</div>
				<div class="col-lg-6">
					<p><?php echo smartyTranslate(array('s'=>'Attachments for this product:'),$_smarty_tpl);?>
</p>
					<select multiple id="selectAttachment1" name="attachments[]">
						<?php  $_smarty_tpl->tpl_vars['attach'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['attach']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['attach1']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['attach']->key => $_smarty_tpl->tpl_vars['attach']->value){
$_smarty_tpl->tpl_vars['attach']->_loop = true;
?>
							<option value="<?php echo $_smarty_tpl->tpl_vars['attach']->value['id_attachment'];?>
"><?php echo $_smarty_tpl->tpl_vars['attach']->value['name'];?>
</option>
						<?php } ?>
					</select>
					<a href="#" id="removeAttachment" class="btn btn-default btn-block">
						<i class="icon-arrow-left"></i>
						<?php echo smartyTranslate(array('s'=>'Remove'),$_smarty_tpl);?>

					</a>
				</div>
			</div>
		</div>
	</div>
	<div class="panel-footer">
		<a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminProducts');?>
" class="btn btn-default"><i class="process-icon-cancel"></i> <?php echo smartyTranslate(array('s'=>'Cancel'),$_smarty_tpl);?>
</a>
		<button type="submit" name="submitAddproduct" class="btn btn-default pull-right"><i class="process-icon-save"></i> <?php echo smartyTranslate(array('s'=>'Save'),$_smarty_tpl);?>
</button>
		<button type="submit" name="submitAddproductAndStay" class="btn btn-default pull-right"><i class="process-icon-save"></i> <?php echo smartyTranslate(array('s'=>'Save and stay'),$_smarty_tpl);?>
</button>
	</div>

	<input type="hidden" name="arrayAttachments" id="arrayAttachments" value="<?php  $_smarty_tpl->tpl_vars['attach'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['attach']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['attach1']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['attach']->key => $_smarty_tpl->tpl_vars['attach']->value){
$_smarty_tpl->tpl_vars['attach']->_loop = true;
?><?php echo $_smarty_tpl->tpl_vars['attach']->value['id_attachment'];?>
,<?php } ?>" />

	<script type="text/javascript">
		var iso = '<?php echo $_smarty_tpl->tpl_vars['iso_tiny_mce']->value;?>
';
		var pathCSS = '<?php echo @constant('_THEME_CSS_DIR_');?>
';
		var ad = '<?php echo $_smarty_tpl->tpl_vars['ad']->value;?>
';
		hideOtherLanguage(<?php echo $_smarty_tpl->tpl_vars['default_form_language']->value;?>
);
	</script>
</div>
<?php }?><?php }} ?>