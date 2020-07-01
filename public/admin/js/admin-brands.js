$(function () {
    $('.js-delete-brand').on('click', function () {
        var self = $(this); // truy cap vao dung phan tu dang dc click
        if(confirm('Ban muon xoa khong ?')){
            var id = self.attr('id');
            var status = self.attr('data-status');
            if($.isNumeric(id) && $.isNumeric(status)) {
                $.ajax({
                    url: urlAjax,
                    type: "POST",
                    data: {id: id, status: status},
                    beforeSend: function () {
                        self.text('Loading ...');
                    },
                    success: function (result) {
                        if(status === '0'){
                            self.text('Unblock');
                        } else if(status === '1'){
                            self.text('Block');
                        }

                        result = $.trim(result);
                        if(result === 'fail' || result === 'err'){
                            alert('Co loi xay ra, vui long thu lai')
                        } else {
                            alert('Thao tac thanh cong');
                            window.location.reload(true);
                        }
                    }
                })
            }
        }
    });

    $('.js-search-brand').on('click', function () {
        var keyword = $('.js-keyword-brand').val().trim();
        if(keyword.length >= 3) {
            window.location.href = urlSearch + "?q=" + keyword;
        }
    });

    // danh rieng cho viec bam enter
    $('.js-keyword-brand').on('keyup',function (event) {
        var self = $(this);
        if(event.keyCode == 13){
            // su kien bam nut enter
            var key = self.val().trim();
            if(key.length >= 3){
                window.location.href = urlSearch + "?q=" + key;
            }
        }
    });
});
