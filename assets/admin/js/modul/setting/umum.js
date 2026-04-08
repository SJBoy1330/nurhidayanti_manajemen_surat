

// The DOM elements you wish to replace with Tagify
var input1 = document.querySelector("#keyword_website");

// Initialize Tagify components on the above inputs
new Tagify(input1);



function tambah_contact(element) {
    const div = document.getElementById('parent_phone');
    const child = div.childElementCount;
    var newCount = (child + 1);

    var html ='';
    html += '<div class="input-group mb-3" id="phone-frame-'+newCount+'">';
    html += '<input type="text" name="name_phone['+newCount+']" class="form-control form-control-lg" placeholder="Nama teller (Opsional)" autocomplete="off"/>';
    html += '<span class="input-group-text" id="phone-62-'+newCount+'">+62</span>';
    html += '<input id="phone" type="text" name="phone['+newCount+']" class="form-control form-control-lg" placeholder="Masukkan nomor telepon" autocomplete="off" aria-describedby="phone-62-'+newCount+'"/>';
    html += '<button class="btn btn-light-danger" type="button" onclick="hapus_contact('+newCount+')">';
    html += ' <i class="fa fa-trash fs-4"></i>';
    html += '</button></div>';

    div.insertAdjacentHTML('beforeend',html);
}


function hapus_contact(num) {
    $('#phone-frame-'+num).remove();
}



function tambah_email(element) {
    const div = document.getElementById('parent_email');
    const child = div.childElementCount;
    var newCount = (child + 1);

    var html ='';
    html += '<div class="input-group mb-3" id="email-frame-'+newCount+'">';
    html += '<input id="email" type="text" name="email['+newCount+']" class="form-control form-control-lg" placeholder="Masukkan alamat email" autocomplete="off"/>';
    html += '<button class="btn btn-light-danger" type="button" onclick="hapus_email('+newCount+')">';
    html += ' <i class="fa fa-trash fs-4"></i>';
    html += '</button></div>';

    div.insertAdjacentHTML('beforeend',html);
}


function hapus_email(num) {
    $('#email-frame-'+num).remove();
}


function set_url_params(pageValue) {
  const url = new URL(window.location.href);
  url.searchParams.set('page', pageValue);
  window.history.pushState({}, '', url);
}



ClassicEditor.create(document.querySelector('#sambutan'), {
    toolbar: {
        items: CKEditor_tool,
    },
    alignment: {
        options: ['left', 'center', 'right', 'justify'],
    },
    table: {
        contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells'],
    },
    link: {
        addTargetToExternalLinks: true, // Add 'target="_blank"' for external links
        decorators: {
            openInNewTab: {
                mode: 'manual',
                label: 'Open in a new tab',
                attributes: {
                    target: '_blank',
                    rel: 'noopener noreferrer'
                }
            }
        }
    },
    fontColor: {
        colors: font_color,
        columns: 5,
        documentColors: 10,
        colorPicker: true,
    },
    fontBackgroundColor: {
        colors: font_color,
    },
    language: 'en',
    licenseKey: '',
}).then((editor) => {
    mysambutan = editor;
})
.catch((error) => {
    console.error(error);
});



ClassicEditor.create(document.querySelector('#about'), {
    toolbar: {
        items: CKEditor_tool,
    },
    alignment: {
        options: ['left', 'center', 'right', 'justify'],
    },
    table: {
        contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells'],
    },
    link: {
        addTargetToExternalLinks: true, // Add 'target="_blank"' for external links
        decorators: {
            openInNewTab: {
                mode: 'manual',
                label: 'Open in a new tab',
                attributes: {
                    target: '_blank',
                    rel: 'noopener noreferrer'
                }
            }
        }
    },
    fontColor: {
        colors: font_color,
        columns: 5,
        documentColors: 10,
        colorPicker: true,
    },
    fontBackgroundColor: {
        colors: font_color,
    },
    language: 'en',
    licenseKey: '',
}).then((editor) => {
    myabout = editor;
})
.catch((error) => {
    console.error(error);
});



ClassicEditor.create(document.querySelector('#visi'), {
    toolbar: {
        items: CKEditor_tool,
    },
    alignment: {
        options: ['left', 'center', 'right', 'justify'],
    },
    table: {
        contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells'],
    },
    link: {
        addTargetToExternalLinks: true, // Add 'target="_blank"' for external links
        decorators: {
            openInNewTab: {
                mode: 'manual',
                label: 'Open in a new tab',
                attributes: {
                    target: '_blank',
                    rel: 'noopener noreferrer'
                }
            }
        }
    },
    fontColor: {
        colors: font_color,
        columns: 5,
        documentColors: 10,
        colorPicker: true,
    },
    fontBackgroundColor: {
        colors: font_color,
    },
    language: 'en',
    licenseKey: '',
}).then((editor) => {
    myvisi = editor;
})
.catch((error) => {
    console.error(error);
});




ClassicEditor.create(document.querySelector('#misi'), {
    toolbar: {
        items: CKEditor_tool,
    },
    alignment: {
        options: ['left', 'center', 'right', 'justify'],
    },
    table: {
        contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells'],
    },
    link: {
        addTargetToExternalLinks: true, // Add 'target="_blank"' for external links
        decorators: {
            openInNewTab: {
                mode: 'manual',
                label: 'Open in a new tab',
                attributes: {
                    target: '_blank',
                    rel: 'noopener noreferrer'
                }
            }
        }
    },
    fontColor: {
        colors: font_color,
        columns: 5,
        documentColors: 10,
        colorPicker: true,
    },
    fontBackgroundColor: {
        colors: font_color,
    },
    language: 'en',
    licenseKey: '',
}).then((editor) => {
    mymisi = editor;
})
.catch((error) => {
    console.error(error);
});



$("#in_time").flatpickr({
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
});

$("#out_time").flatpickr({
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
});


function time_set_null(id) {
    $(id).val('');
}