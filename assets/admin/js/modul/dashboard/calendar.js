document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('kt_calendar_app');
    
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: function(fetchInfo, successCallback, failureCallback) {
            let startDate = formatDate(fetchInfo.start);
            let endDate = formatDate(fetchInfo.end);
            
            $.ajax({
                url: BASE_URL + '/dashboard/cuti',
                type: 'POST',
                data: { 
                    _token : csrf_token,
                    start: startDate, 
                    end: endDate 
                },
                cache: false,
                dataType: 'json',
                success: function(response) {
                    let events = response.map(event => {
                        let startDate = new Date(event.start);
                        let endDate = new Date(event.end);

                        // Jika start dan end sama, pastikan tetap terlihat
                        let isSingleDay = startDate.toDateString() === endDate.toDateString();
                        return {
                            ...event,
                            allDay: isSingleDay, // Pakai allDay jika hanya 1 hari
                            display: 'block'     // Pastikan tetap terlihat
                        };
                    });

                    successCallback(events);
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", status, error);
                    failureCallback([]);
                }
            });
        },
        eventContent: function(arg) {
            var photoUrl = arg.event.extendedProps.photo || ''; 
            var userText = arg.event.extendedProps.user || '';

            var imgEl = document.createElement('div');
            imgEl.style.width = '40px';
            imgEl.style.height = '40px';
            imgEl.style.margin = '5px 5px 5px 10px'; 
            imgEl.style.borderRadius = '50%';
            imgEl.style.backgroundSize = 'cover';
            imgEl.style.backgroundPosition = 'center';

            if (photoUrl) {
                imgEl.style.backgroundImage = `url('${photoUrl}')`;
            } else {
                imgEl.style.backgroundColor = '#ccc';
            }

            var tipe_event = document.createElement('span');
            tipe_event.innerText = 'CUTI : ';
            tipe_event.style.fontWeight = 'bold';
            tipe_event.style.fontSize = '12px';
            tipe_event.style.marginRight = '3px';

            var titleEl = document.createElement('span');
            titleEl.innerText = arg.event.title;

            var final_title = document.createElement('div');
            final_title.style.display = 'flex';
            final_title.style.alignItems = 'center';
            final_title.style.justifyContent = 'center';
            final_title.style.textAlign = 'center';
            final_title.appendChild(tipe_event);
            final_title.appendChild(titleEl);

            var userEl = document.createElement('span');
            userEl.innerText = userText;
            userEl.style.color = '#FFFFFF';
            userEl.style.fontSize = '12px';

            var wrapper = document.createElement('div');
            wrapper.style.display = 'flex';
            wrapper.style.flexDirection = 'column';
            wrapper.style.marginLeft = '5px';
            wrapper.appendChild(userEl);
            wrapper.appendChild(final_title);

            var containerEl = document.createElement('div');
            containerEl.style.display = 'flex';
            containerEl.style.alignItems = 'center';
            containerEl.appendChild(imgEl);
            containerEl.appendChild(wrapper);

            return { domNodes: [containerEl] };
        }
    });

    calendar.render();
});

// Fungsi untuk memformat tanggal ke YYYY-MM-DD
function formatDate(date) {
    let d = new Date(date);
    let year = d.getFullYear();
    let month = String(d.getMonth() + 1).padStart(2, '0');
    let day = String(d.getDate()).padStart(2, '0');
    return `${year}-${month}-${day}`;
}