
$(document).on("click", ".open-Modal", function () {
    var id = $(this).data('id');
    $(".modal-body #candidate_id").val(id);
});
