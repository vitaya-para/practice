window.onload = function () {
    const ids = ["email", "group", "teacher_id", "topic", "direction", "direction_name","date"];
    let sort = (new URL(document.location.href).searchParams.get('sort')) ?? "email";
    let outChar = "↑";
    if (sort.charAt(0) === "-") {
        outChar = "↓";
        sort = sort.substring(1);
    }
    elem = document.getElementById(sort);
    elem.textContent = elem.textContent + outChar;
    for (let id of ids) {
        document.getElementById(id).addEventListener("click", function () {
            let params = new URL(document.location.href);
            let sort = params.searchParams.get('sort');
            if (sort == null || id !== sort) {
                params.searchParams.set('sort', id);
            } else {
                params.searchParams.set('sort', '-' + id);
            }
            document.location.href = params;
        });
    }
    let params = new URL(document.location.href);
    let elem1 = document.getElementById("per_page_id");
    elem1.addEventListener('change', function (){
        params.searchParams.set('per_page', elem1.value);
        params.searchParams.set('page', 1);
        document.location.href = params;
    })
    elem1.value = params.searchParams.get('per_page')??10;
}

