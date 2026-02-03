</div>
</div>
</div>
</div>
<script>
    (function($) {

        toastr.options = {
            // "closeButton": true,
            "progressBar": true,
            "newestOnTop": true
            // "positionClass": "toast-top-full-width"
        };

        <?php if($errors->any()): ?>
            <?php foreach($errors->all() as $error): ?>
                toastr.error('{{ $error }}', 'Lỗi');
            <?php endforeach; ?>
        <?php endif; ?>
        
        <?php if(session()->has('success')): ?>
            toastr.success("{!! session('success') !!}");
        <?php endif; ?>

    })(jQuery);
</script>
