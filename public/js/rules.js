$(document).ready(function(){
    const Tittle1FR = "But du jeu"
    const Tittle2FR = "Cartes Nom de Code"
    const Tittle3FR = "Cartes Clé"
    const img1 = "../images/rulesPage/RulesGoal.png"
    const img2 = "../images/rulesPage/RulesCard.png"
    const img3 = "../images/rulesPage/RulesKeyCard.png"
    const Text1FR = "<p>Chaque joueur connaît une partie des Noms de Code à trouver. Il va donc falloir coopérer pour" +
        " trouver l’ensemble des Noms de Code avant la fin des 9 tours. Pour cela, chacun à votre tour, vous donnez un indice pouvant désigner plusieurs Noms de Code sur la table. Votre partenaire, quant à lui, tente de deviner ces Noms de Code tout en évitant de rencontrer l’un des terribles Assassins qui vous font perdre la partie.\n" +
        "Trouvez l’ensemble des 15 Noms de Code avant la fin des 9 tours pour remporter la victoire.</p>"
    const Text2FR = "<p>Les cartes Nom de Code correspondent aux mots que vous devez deviner ou faire deviner à votre" +
        " partenaire durant la partie. \n" +
        "Trouvez l’ensemble des 15 Noms de Code avant la fin des 9 tours pour remporter la victoire.</p>"
    const Text3FR = "<p>La carte Clé indique quels sont les Noms de Code à trouver pour cette partie. La Clé est" +
        " recto-verso, et chaque côté correspond à la grille de cartes posées sur la table : ❱❱\n" +
        "En vert : les Noms de Code à trouver pour remporter la partie. ❱❱ \n" +
        "En beige : des mots Neutres qui vous font perdre du temps. ❱❱ \n" +
        "En noir : les Assassins qui ne doivent être trouvés sous aucun prétexte ! </p>"
    const Tittle1EN = "Goal of the game"
    const Tittle2EN = "Code Name Cards"
    const Tittle3EN = "Key Card"
    const Text1EN = "<p>Each player knows a part of the Code Names to find. It will therefore be necessary to cooperate to" +
        " find all the Code Names before the end of the 9 rounds. For this, each in turn, you give an indication that can designate several Code Names on the table. Your partner, on the other hand, tries to guess these Code Names while avoiding meeting one of the terrible Assassins who make you lose the game.\n" +
        "Find all 15 Code Names before the end of the 9 rounds to win the victory.</p>"
    const Text2EN = "<p>The Code Name cards correspond to the words that you must guess or make your partner guess during the game.\n" +
        "Find all 15 Code Names before the end of the 9 rounds to win the victory.</p>"
    const Text3EN = "<p>The Key card indicates which Code Names to find for this game. The Key is" +
        " recto-verso, and each side corresponds to the grid of cards placed on the table: ❱❱\n" +
        "In green: the Code Names to find to win the game. ❱❱ \n" +
        "In beige: Neutral words that make you lose time. ❱❱ \n" +
        "In black: the Assassins that must not be found under any pretext!</p>"
    if ($("#language").text() == "fr"){
        traductionFR()
    }else{
        traductionEN()
    }
    function traductionFR(){
        return rules =[[1,Tittle1FR, '<img src="'+img1+'">',Text1FR],[2,Tittle2FR,'<img src="'+img2+'">', Text2FR],[3,Tittle3FR,'<img src="'+img3+'">', Text3FR]]
    }
    function traductionEN(){
        return rules =[[1,Tittle1EN, '<img src="'+img1+'">',Text1EN],[2,Tittle2EN,'<img src="'+img2+'">', Text2EN],[3,Tittle3EN,'<img src="'+img3+'">', Text3EN]]
    }

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
        $('#rulesImage').html(rules[currentRule-1][2])
        $('#rulesContent').html(rules[currentRule-1][3])
    })
})