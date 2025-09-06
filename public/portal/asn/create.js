const slots = document.querySelectorAll('.time-slot');
let selectedSlot = null;

slots.forEach(slot => {
    slot.addEventListener('click', function () {
        slots.forEach(s => s.classList.remove('active'));
        this.classList.add('active');
        selectedSlot = this.textContent;
    });
});

document.getElementById('clearSelection').addEventListener('click', function () {
    document.getElementById('date').value = "";
    slots.forEach(s => s.classList.remove('active'));
    selectedSlot = null;
});

$(document).ready(function () {
    $("#no_of_vehicle").change(function (e) { 
        e.preventDefault();
        let no_of_vehicle = $(this).val();

        let option_html = '<option value = "" selected disabled>---Select Load---</option>';
        for (let i = 1; i <= no_of_vehicle; i++) {
            option_html += "<option value = 'LOAD_"+i+"'>LOAD_"+i+"</option>"
        }
        console.log(option_html);

        $('.load-dropdown').html(option_html);
        // $('.selectpicker').selectpicker("refresh");
    });
});
