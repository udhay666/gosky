$(window).load(function(){});$(window).scroll(function(){$('.mobile-header').toggleClass('scrolled',($(this).scrollTop()>20))});$(document).keydown(function(e){var $dialog=$(".dialog.active");if($dialog.length>0&&$dialog.attr("keyboard")){e.stopPropagation();switch(e.keyCode){case 27:$dialog.removeClass("active");$dialog.attr('data-ref','');$('body').removeClass('dialog-on');break}}});$(document).ready(function(){$('.trigger-drawer, .overlay').on('click',function(event){$('.drawer').toggleClass('show');$('body').toggleClass('drawer-on')});$('.trigger-back,.trigger-close-dialog').on('click',function(event){event.stopPropagation();var $dialog=$(this).closest('.dialog');$dialog.removeClass("active");$dialog.attr('data-ref','');$('body').toggleClass('dialog-on')});$('.trigger-dialog').on('click',function(event){var $this=$(this),dialog_name=$this.attr('data-target')?$this.attr('data-target'):$this.attr('href');$('body').toggleClass('dialog-on');$(dialog_name).toggleClass('active');$(dialog_name).attr('data-ref',($this.attr('id')?'#'+$this.attr('id'):''))});$('.confirm-dialog').on('click',function(){var $this=$(this),$dialog=$this.closest('.dialog'),ref=$dialog.data('ref');$this.trigger('confirmed-dialog',[$dialog,$(ref)]);$('body').removeClass('dialog-on');$dialog.removeClass('active');$dialog.attr('data-ref','')})})
function tog(v){return v?'addClass':'removeClass'};$(document).on('input','.clearable',function(){$(this)[tog(this.value)]('x')}).on('mousemove','.x',function(e){$(this)[tog(this.offsetWidth-18<e.clientX-this.getBoundingClientRect().left)]('onX')}).on('touchstart click','.onX',function(ev){ev.preventDefault();$(this).removeClass('x onX').val('').change()});$('.clearable').trigger("input")