$(document).ready(function(){
    $('.unMariage').click(function(){
        $.confirm({
            title: 'Adnane & Hasna',
            content: `
                <style>
                    .font-regular {
                        font-family: 'Parisienne';
                    }

                    .text-purple {
                        color: #800080;
                    }
                </style>
                <h3 for="" class="text-left pl-2 font-regular text-purple font-weight-bold">Festivité</h3>
                <select name="" id="" class="custom-select">
                    <option value="">Mairie</option>
                    <option value="">Eglise</option>
                    <option value="">Espace</option>
                </select>
                <h3 for="" class="text-left pl-2 mt-3 font-regular text-purple font-weight-bold">Type</h3>
                <select name="" id="" class="custom-select">
                    <option value="">Albums</option>
                    <option value="">Video</option>
                    <option value="">Audio</option>
                </select>
            `,
            theme:'modern',
            type: 'purple',
            buttons: {
                Annuler: function () {
                    $.alert('Canceled!');
                },
                OK: {
                    text: 'OK',
                    btnClass: 'btn-blue',
                    keys: ['enter'],
                    action: function(){
                        $.alert('OK');
                    }
                }
            }
        });
    })

var host = window.location.protocol + "//" + window.location.host;

function affichageFestivite(data)
{
    $(data.selector).click(function(e){
        e.preventDefault()
        
        $.confirm({
            title: data.title,
            content: `
                <style>
                    .font-regular {
                        font-family: 'Parisienne';
                    }

                    .text-purple {
                        color: #800080;
                    }
                </style>
                <h3 for="" class="text-left pl-2 font-regular text-purple font-weight-bold">Mariage</h3>
                <input type="text" class="form-control" placeholder="Taper ici" >
                <h3 for="" class="text-left pl-2 mt-3 font-regular text-purple font-weight-bold">Festivité</h3>
                <select name="" id="" class="custom-select">
                    <option value="">Mairie</option>
                    <option value="">Eglise</option>
                    <option value="">Espace</option>
                </select>
            `,
            theme:'modern',
            type: 'purple',
            buttons: {
                Annuler: function () {
                    $.alert('Canceled!');
                },
                OK: {
                    text: 'OK',
                    btnClass: 'btn-blue',
                    keys: ['enter'],
                    action: function(){
                        location.assign(host + data.route) ;
                    }
                }
            }
        });
    })
    return false ;
}

var data1 = {
    selector : '.album',
    title : 'Albums',
    route : '/albums'
}

var data2 = {
    selector : '.video',
    title : 'Videos',
    route : '/videos'
}

var data3 = {
    selector : '.audio',
    title : 'Audio',
    route : '/audio'
}

affichageFestivite(data1) ;
affichageFestivite(data2) ;
affichageFestivite(data3) ;

// function activer()
// {
//     var sec = Math.floor(this.duration % 60);
//     $('#maVideo').currentTime = (sec*25)/100
// }


// $('#maVideo').mouseover(function(){
//     var sec = Math.floor(this.duration % 60);
//     this.currentTime = (sec*25)/100
//     this.play()
// })

})