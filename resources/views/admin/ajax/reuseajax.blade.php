<script>
    let reuseAjax = (function($) {
        let ajaxCallMethod = {};

        ajaxCallMethod.post = function(url, data, success, error) {
            $.ajax({
                url: url,
                type: "POST",
                data: data,
                success: function(result) {
                    success(result);
                },
                error: function(ex) {

                    error(ex);
                }
            });
        };

        ajaxCallMethod.get = function(url, success, error) {
            $.ajax({
                url: url,
                type: "GET",
                success: function(result){
                    success(result);
                },
                error: function(ex) {
                    error(ex);
                }
            })
        }

        return ajaxCallMethod;

    }(jQuery));
</script>