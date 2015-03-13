<script>

	var gal = $('.uncomplete-gallery');

	gal.each(function(){
		var self = $(this);
		self.photosetGrid({
			highresLinks: true,

			onComplete: function(){
				self.find('a').attr('data-lightbox', self.data('image') );
				self.removeClass('uncomplete-gallery');
			}
		});
	});
	
</script>