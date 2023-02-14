$(document).ready(function(){
    var host = window.location.protocol + "//" + window.location.host+"/Mariage/public/index.php";

    // var host2 = window.location.protocol + "//" + window.location.host+"/mariage/public";
    // var NumberToLetter = require(host2+'/nombre_en_lettre.js');

    $('.ajout_panier').click(function(){
        var self = $(this)
        $.confirm({
            title: 'Ajout',
            content: 'Voulez-vous ajouter au panier ?',
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
                            theme:'modern',
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
                                                    $.alert('Article ajoutée')
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
        var self = $(this)
        $.confirm({
            title: 'Suppression',
            content: 'Etes-vous sûre de vouloir supprimer ?',
            buttons : {
                NON: function()
                {

                },
                Oui: {
                    text: 'OUI',
                    btnClass: 'btn-blue',
                    keys: ['enter'],
                    action: function(){
                        $.ajax({
                            url: host + '/supprimer/panier',
                            type: 'post',
                            data: {
                                article: self.attr("value"),
                            },
                            dataType: 'json',
                            success: function(result) {
                                if(result.msg == "success")
                                {

                                    var valTG = $('.valTG').val()
                                    var totalGeneral = valTG - parseInt(self.attr('totalP'))
                                    $('.valTG').val(totalGeneral)
                                    $('.totalG').text(totalGeneral)

                                    // chiffreEnLettre();
                                    self.closest('tr').remove()
                                }
                            }
                          });
                    }
                }  
            }
          })
    })

    $('.btn_commander').click(function(){
        $.confirm({
            title: 'Enregistrement',
            content: 'Etes-vous sûre de vouloir enregistrer ?',
            buttons : {
                Annuler: function()
                {

                },
                Oui: {
                    text: 'Oui',
                    btnClass: 'btn-blue',
                    keys: ['enter'],
                    action: function(){
                        $.confirm({
                            title: 'Entrer vos informations',
                            content: `<form method="POST">
                                    <input type="text" name="cmd_nom" class="form-control mt-3 cmd_nom" placeholder="Nom">
                                    <input type="text" name="cmd_prenom" class="form-control mt-3 cmd_prenom" placeholder="Prénoms">
                                    <input type="text" name="cmd_adresse" class="form-control mt-3 cmd_adresse" placeholder="Adresse">
                                    <input type="text" name="cmd_telephone" class="form-control mt-3 cmd_telephone" placeholder="Téléphone">
                                    <input type="email" name="cmd_email" class="form-control mt-3 cmd_email" placeholder="E-mail">
                                </form>`,
                            theme:'modern',
                            type:'green',
                            buttons : {
                                Annuler: function()
                                {

                                },
                                Valider: {
                                    text: 'Valider',
                                    btnClass: 'btn-green',
                                    keys: ['enter'],
                                    action: function(){
                                        var cmd_nom = $('.cmd_nom').val()
                                        var cmd_prenom = $('.cmd_prenom').val()
                                        var cmd_adresse = $('.cmd_adresse').val()
                                        var cmd_telephone = $('.cmd_telephone').val()
                                        var cmd_email = $('.cmd_email').val()

                                        $.ajax({
                                            url: host + '/enregistrer/panier',
                                            type: 'POST',
                                            data: {
                                                cmd_nom:cmd_nom,
                                                cmd_prenom:cmd_prenom,
                                                cmd_adresse:cmd_adresse,
                                                cmd_telephone:cmd_telephone,
                                                cmd_email:cmd_email,
                                            },
                                            dataType: 'json',
                                            success: function(result) {
                                                if(result.msg == "success")
                                                {
                                                    location.assign(host + '/boutiques') ;
                                                }
                                                else
                                                {
                                                    $.alert("Erreur d'enregistrement")
                                                }

                                                
                                            }
                                        });

                                    }
                                }  
                            }
                        })
                    }
                }  
            }
          })

    })

    
    $('.btn_annuler').click(function(){
        $.confirm({
            title: 'Annulation',
            content: 'Etes-vous sûre de vouloir Annuler ? <br> Toutes vos panier seront perdus ',
            type: 'red' ,
            buttons : {
                Annuler: function(){},
                Oui: {
                    text: 'Oui',
                    btnClass: 'btn-red',
                    keys: ['enter'],
                    action: function(){
                        $.ajax({
                            url: host + '/suppression/all/panier',
                            type: 'post',
                            data: {},
                            dataType: 'json',
                            success: function(result) {
                                if(result.msg == "success")
                                {
                                    location.assign(host + '/boutiques') ;
                                }
                            }
                        });
                    }
                }  
            }
          })
    })

    // function chiffreEnLettre()
    // {
        
    //     var valTG = $('.valTG').val()
    //     $('.totalGEnLetre').text(NumberToLetter(valTG)) ; 
    // }

    // chiffreEnLettre();

    $('.bloc_article').click(function(){
        var id = $(this).attr('value')
        location.assign(host+'/detail/actualite/'+id)
    })
})