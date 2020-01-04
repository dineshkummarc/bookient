<script type="text/javascript">
    $(document).ready(function () {
        $('#submitVal').click(function () {
            $.ajax({
                type: "POST",
                url: SITE_URL+'superadmin/membership_allocation/relationInsert',
                datatype: 'html',
                data: $("form").serialize(),
                success: function (data) {
                    alert("Data inserted successfully");
                    window.location.reload(true);
                }
            });
        });
    });
</script>