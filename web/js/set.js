$(function($){
        $('#color').iphoneStyle({
 	 	checkedLabel: 'White',
  		uncheckedLabel: 'Black'
        });
        $('#source').iphoneStyle({
 	 	checkedLabel: 'Stock',
  		uncheckedLabel: 'MPI'
        });
        $('#chooselogo').shImageSelectDropdown({
            theme: 'minimal',
            expandDirection: 'up-down',
            easing: {
                open: 'easeOutBounce',
                close: 'easeInCirc'
            },
            animationSpeed: {
                open: 1000,
                close: 700
            }
        });
        });