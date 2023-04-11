$(document).ready(function(){
    const Tittle1 = "But du jeu"
    const Tittle2 = "Cartes Nom de Code"
    const Tittle3 = "Cartes Clé"
    const img1 = "images/rulesPage/RulesGoal.png"
    const img2 = "images/rulesPage/RulesCard.png"
    const img3 = "images/rulesPage/RulesKeyCard.png"
    const Text1 = "Chaque joueur connaît une partie des Noms de Code à trouver. Il va donc falloir coopérer pour trouver l’ensemble des Noms de Code avant la fin des 9 tours. Pour cela, chacun à votre tour, vous donnez un indice pouvant désigner plusieurs Noms de Code sur la table. Votre partenaire, quant à lui, tente de deviner ces Noms de Code tout en évitant de rencontrer l’un des terribles Assassins qui vous font perdre la partie.\n" +
        "Trouvez l’ensemble des 15 Noms de Code avant la fin des 9 tours pour remporter la victoire."
    const Text2 = "Les cartes Nom de Code correspondent aux mots que vous devez deviner ou faire deviner à votre partenaire durant la partie. \n" +
        "Trouvez l’ensemble des 15 Noms de Code avant la fin des 9 tours pour remporter la victoire."
    const Text3 = "La carte Clé indique quels sont les Noms de Code à trouver pour cette partie. La Clé est recto-verso, et chaque côté correspond à la grille de cartes posées sur la table : ❱❱\n" +
        "En vert : les Noms de Code à trouver pour remporter la partie. ❱❱ \n" +
        "En beige : des mots Neutres qui vous font perdre du temps. ❱❱ \n" +
        "En noir : les Assassins qui ne doivent être trouvés sous aucun prétexte !"
    var rules =[[1,Tittle1, '<img src="'+img1+'">',Text1],[2,Tittle2,'<img src="'+img2+'">', Text2],[3,Tittle3,'<img src="'+img3+'">', Text3]]

    var currentRule = 1
    $('#rulesTittle').html(rules[currentRule-1][1])
    $('#rulesImage').html(rules[currentRule-1][2])
    $('#rulesContent').html(rules[currentRule-1][3])

    function updateRulesLeft(){
        if (currentRule == 1){
            currentRule += 1
        }else if (currentRule == 2){
            currentRule += 1
        }else if (currentRule == 3){
            currentRule = 1
        }
    }
    function updateRulesRight(){
        if (currentRule == 3){
            currentRule -= 1
        }else if (currentRule == 2){
            currentRule -= 1
        }else if (currentRule == 1){
            currentRule = 3
        }
    }
    $('#rulesLeft').click(function (){
        updateRulesLeft()
        $('#rulesTittle').html(rules[currentRule-1][1])
        $('#rulesImage').html(rules[currentRule-1][2])
        $('#rulesContent').html(rules[currentRule-1][3])
    })
    $('#rulesRight').click(function (){
        updateRulesRight()
        $('#rulesTittle').html(rules[currentRule-1][1])
        $('#rulesImage').html(rules[currentRule][2])
        $('#rulesContent').html(rules[currentRule-1][3])
    })
})