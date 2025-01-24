
<script>
    $(document).ready(function(){

        $('.fsubmit').change(function() {
            this.form.submit();
        });

        let count = 1;
        // getting user profile data
        $(".user_profile").click(function() {
            let userid = $(this).data("user_id");

            let url = "{{route("admin.userDataBy",["profile",":id"])}}";
                url = url.replace(':id', userid);
            reuseAjax.get(
                url,
                function (data) {
                    $("#profileBody").html(
                        `<tr>
                            <td>${count}</td>
                            <td><img src="${data.profile_img}" /></td>
                            <td>${data.languages}</td>
                            <td>${data.softwares}</td>
                            <td>${data.specialization}</td>
                            <td>${data.colleges.name}</td>
                            <td>${data.graduation_year}</td>
                        </tr>`);


                },
                function () { console.error('failure');}
            );
        });


        // getting user documents data
        $(".user_document").click(function() {
            let userid = $(this).data("user_id");

            let url = "{{route("admin.userDataBy",["documents",":id"])}}";
            url = url.replace(':id', userid);
            reuseAjax.get(
                url,
                function (data) {
                    $.each(data, function() {
                        $("#documentBody").append(
                            `<tr>
                                    <td>${count}</td>
                                    <td>${this.title}</td>
                                    <td><a href="${this.file}" target="_blank">File</a></td>
                                    <td><a href="${this.file_thumb}" target="_blank">Cover</a></td>
                                    <td>${this.file_type}</td>
                                    <td>${this.status }</td>

                        </tr>`
                        );
                        count++;

                    });
                },
            );
            });

        // getting user experience data
        $(".user_experience").click(function() {
            let userid = $(this).data("user_id");

            let url = "{{route("admin.userDataBy",["experiences",":id"])}}";
            url = url.replace(':id', userid);
            reuseAjax.get(
                url,
                function (data) {
                    $.each(data, function() {
                        $("#experienceBody").append(
                            `<tr>
                                    <td>${count}</td>
                                    <td>${this.office}</td>
                                    <td>${this.position}</td>
                                    <td>${this.start_date}</td>
                                    <td>${this.end_date }</td>

                        </tr>`
                        );
                        count++;

                    });
                }
                )
            });

        // popup close after that set empty data
        $(function(){
            $('#user_profile').on('hidden.bs.modal', function (e) {
                count = 1;
                $("#profileBody").html("");

            });
        });

        $(function(){
            $('#user_document').on('hidden.bs.modal', function (e) {
                count = 1;
                $("#documentBody").html("");
            });
        });

        $(function(){
            $('#user_experience').on('hidden.bs.modal', function (e) {
                count = 1;
                $("#experienceBody").html("");
            });
        });
    });





    /****************************************
     *       Basic Table                   *
     ****************************************/


</script>
