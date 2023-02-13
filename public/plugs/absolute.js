$(document).ready(function(){
    var host = window.location.protocol + "//" + window.location.host+"/mariage/public/index.php";
   
    $('.ajout_panier').click(function(){
        var self = $(this)
        $.confirm({
            title: 'Voulez-vous ajouter au panier ? ',
            content: '',
            theme :'modern',
            type:'purle',
            buttons: {
                NON: function () {
                    
                },
                OUI: {
                    text: 'OUI',
                    btnClass: 'btn-blue',
                    keys: ['enter'],
                    action: function(){
                        $.confirm({
                            title: 'Quantité',
                            content: '<input type="number" class="form-control qteProd" placeholder="Quantité" >',
                            buttons: {
                                Annuler: function () {
                                    
                                },
                                Valider: {
                                    text: 'Valider',
                                    btnClass: 'btn-blue',
                                    keys: ['enter'],
                                    action: function(){
                                        var qteProd = $('.qteProd').val()
                                        $.ajax({
                                            url: host + '/ajout/panier',
                                            type: 'post',
                                            data: {
                                                article: self.attr("value"),
                                                qteProd:qteProd
                                            },
                                            dataType: 'json',
                                            success: function(result) {
                                                if(result.msg == "success")
                                                {
                                                    $.alert('Réussie')
                                                }
                                            }
                                        });
                                    }
                                }
                            }
                        });
                        
                    }
                }
            }
        });
        
            
        
        return false ;
    }) 

    $('.supprPanier').click(function(){
        // $(this).closet('tr').remove()
    })

})