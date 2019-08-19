var x = 0;

function inputPeopleGroup() {
    let k;
    let field_6 = $("#fieldCountCreateGroup");
    if (x > field_6.val()) {
        let j;
        for (j = x; j > field_6.val(); j--) {
            k = j - 1;
            $(".el" + k).remove();
        }
        x = j;
    } else  if (x < field_6.val()) {
        let i;
        for (i = x; i < field_6.val(); i++) {
            $('.createfield').append('<tr class="el' + i + '"><td>' + (1 + i) + '</td><td><input type="text" name="people'+ i +'" style="width: 200px;"/></td></tr>');
        }
        x = i;
    }
}

function createColumns() {
    $('.titleRowTable').append('<td><input type="text" placeholder="Инструкция при наведение" name="titleAddColumns" title="Для ввода следует использовать наименование занятия, т.e. ОКР1, ОКР2, Практическое1, Лабораторная1 и т.д."></td>');

    for (i = 1; i <= domain; i++) {
        $('.contentRowTable'+ i +'').append('<td><input type="text" name="informationColumn'+ i +'"></td>');
    }
}