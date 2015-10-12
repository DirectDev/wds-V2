<?php

namespace Front\FrontBundle\DataFixtures\ORM;

trait FixturesDataTrait {

    protected $array_locale = array('en', 'fr');
    protected $array_musictype = array('salsa', 'bachata', 'tango', 'kizomba', 'merengue', 'zouk');
    protected $array_eventtype = array('party', 'festival', 'workshop', 'lesson', 'show', 'concert', 'workshop_party');
    protected $array_user_dancer = array(
        'marie',
        'john',
        'marc',
        'paul',
        'rebecca',
        'alex',
        'tchen',
        'beth',
        "SOHAN",
        "LEVANAH",
        "SACHA",
        "LINA",
        "NINO",
        "MARGAUX",
        "MATHIS",
        "SALOME",
        "ENZO",
        "INES",
        "WAEL",
        "AUDREY",
        "PANAYOTIS",
        "MATHILDE",
        "THEO",
        "THECLE",
        "HAYDEN",
        "MANEL",
        "CLEO",
        "LEVANA",
        "MAXENCE",
        "SWANN",
        "YANIS",
        "MANON",
        "JULIAN",
        "AGATHE",
        "GUILHEM",
        "FERIEL",
        "YOHAN",
        "ELYA",
        "DYLAN",
        "GARANCE",
        "MOHAMED",
        "CAMILLE",
        "LIAM",
        "CELIA",
        "EVAN",
        "HANAE",
        "LEANDRE",
        "EMMA",
        "TRISTAN",
        "MILA",
        "LUDOVIC",
        "AYLIN",
        "EDEN",
        "LAURA",
        "CELESTE",
        "ALICIA",
        "CORENTIN",
        "LISE"
    );
    protected $array_user_teacher = array(
        'salsa y passion',
        'salsa loca',
        'amor de salsa',
        'los bailadores',
        'Salsa de la calle',
        'rythmes latins',
        'sensualité et danse',
        'africasalsa',
        'dance & fun',
        'bests salsa teachers',
        'learn to dance',
        "latino's rythms",
    );
    protected $array_user_artist = array(
        "john & miranda",
        "marc et sophie",
        "passionSalsa",
        "salsa y tu",
        "gente Loca",
        "los tamborinos",
        "the salsa players",
        "Mr Salsa",
        "dadee cuba",
        "los cubatoneros",
        "love salsa",
        "los cantadores",
    );
    protected $array_user_bar = array(
        "El rojo",
        "B-sky",
        "Mac",
        "le Rezo",
        "Les quais",
        "Fishwarf",
        "The marina bar",
        "le Chateau",
        "The latino",
        "La salle des fetes",
        "La salle de danse",
        "Drink's",
        "Champagne bar",
        "Vodka bar",
        "Beer's bar",
        "Casino bar",
        "French club",
        "Cuba bar",
        "Le Mexico",
        "Casino",
        "Irsh Pub",
        "L'opéra bar",
        "Rueda bar",
        "Champagne club",
        "Vodka club",
        "Beer's club",
        "Casino club",
        "Casino royal",
        "French bar",
        "Cuba club",
        "Le Peruano",
        "Casino fever",
        "Irsh club",
        "L'opéra club",
        "El Toro",
    );
    protected $array_user = array();
    protected $array_baseline = array(
        'Maecenas porta nulla quis tempor hendrerit.',
        'Vestibulum sit amet lorem a urna iaculis ornare non eu lacus.',
        'Nam euismod diam mollis magna hendrerit, ac porta ante tincidunt.',
        'Ut sed nisl posuere, eleifend magna et, ornare augue.',
        'Suspendisse congue augue eu gravida egestas.',
        'Quisque ultrices erat at nibh mollis rhoncus.',
        'Sed viverra metus vitae accumsan sollicitudin.',
        'Cras fringilla lectus id ullamcorper ultricies.',
        'Proin faucibus libero vitae tempor bibendum.',
        'Duis suscipit mi id nisi mollis, vitae ultricies tellus ultricies.',
        'Phasellus volutpat lacus scelerisque libero mollis vulputate.',
        'Vestibulum quis elit eu tellus pretium fermentum eget quis est.',
        'Quisque semper risut mauris vehicula vulputate.',
        'Maecenas sit amet justo mattis, eleifend nulla non, fringilla justo.',
        'Nulla aliquet nunc vitae sem pretium volutpat.',
        'Mauris finibus massa ac pellentesque scelerisque.',
        'Pellentesque id ligula in ipsum semper cursus.',
        'Integer commodo massa sed lorem consectetur, non commodo magna rhoncus.',
        'Vestibulum non ipsum pretium, fermentum ligula at, elementum odio.',
        'Vivamus tempus nisl ac urna rutrum aliquet.',
    );
    protected $array_description = array(
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent in sem metus. Duis blandit consectetur est nec hendrerit. Nam at tortor eu nisi tempor consequat nec quis augue. Suspendisse vel porta ligula. Proin commodo purus fringilla tempus pretium. Suspendisse ut enim sit amet urna consequat pulvinar. Duis enim arcu, facilisis ut mi non, volutpat scelerisque urna. Sed accumsan eros non ligula auctor, sed convallis nisl sagittis. Cras viverra, nisi at lacinia tristique, nibh orci dapibus nisl, at viverra urna magna nec elit. Duis viverra magna velit, eu ornare lectus scelerisque at. Donec cursus et nibh vitae cursus. Nulla condimentum ex venenatis urna volutpat pharetra. Mauris vel aliquam augue. Aliquam nec risus vestibulum, varius est ut, sollicitudin est.',
        'Sed sed rhoncus massa. Sed sit amet posuere tortor, at sollicitudin quam. Duis ut pharetra velit, placerat fringilla justo. Curabitur sodales nibh at nibh euismod posuere. Nam eget sem eu lacus elementum malesuada. Integer fringilla leo sed metus faucibus, et semper neque laoreet. Phasellus dignissim vitae dui sed feugiat. Aenean tempor, dui quis semper fermentum, ex velit tristique ex, ut finibus augue turpis quis erat. Etiam varius eget eros vel vehicula.',
        'Phasellus vel nisl convallis, consectetur erat vehicula, elementum est. Donec aliquam felis sed enim viverra lobortis. Sed maximus egestas ipsum eu interdum. Duis neque purus, porttitor sit amet turpis id, placerat scelerisque massa. Maecenas blandit, neque rutrum ultricies suscipit, purus lorem convallis orci, quis tincidunt lectus urna eget dolor. Ut blandit vehicula convallis. Aliquam eu dictum ipsum. In dignissim pharetra enim ut cursus. Etiam volutpat sed massa at iaculis. In malesuada in quam eu rhoncus. Maecenas dictum a ipsum vitae interdum. Proin in scelerisque sapien. Fusce sollicitudin tellus id lacus semper, suscipit consequat est auctor. Vivamus laoreet, est sagittis eleifend molestie, arcu neque dapibus neque, et commodo dui lectus non massa. Donec ac convallis turpis.',
        'Quisque lobortis at augue vel elementum. Praesent porttitor velit a nunc dictum, ac vestibulum est efficitur. Nulla congue auctor aliquet. Fusce metus odio, luctus id libero non, cursus consectetur ante. Aliquam a hendrerit quam. Donec quis purus in tellus rutrum consequat sed et sem. Nullam laoreet quam non congue auctor. Aenean mattis elit ac consequat ultrices. Donec maximus, velit in ornare euismod, lectus ante consequat sapien, at aliquet lorem leo id est. Phasellus euismod leo a nunc viverra tincidunt. Nulla ut tempor purus. Donec placerat mollis porttitor. Integer laoreet leo eget lectus efficitur, eget mattis augue semper. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.',
        'Curabitur sit amet enim id mauris sodales aliquet. Duis fermentum nibh a placerat luctus. Sed vel pellentesque enim. Aenean nec nulla gravida turpis pulvinar gravida. Morbi finibus massa molestie quam posuere tincidunt. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus id neque viverra, molestie nunc a, fringilla justo. Sed efficitur faucibus lacus et convallis. Phasellus congue sollicitudin porta. Etiam eu venenatis quam. Maecenas justo ante, ultricies id risus quis, bibendum luctus enim. Cras consectetur dictum sollicitudin. Ut auctor, purus at mollis porttitor, leo quam feugiat odio, non placerat sem felis id purus. Cras dolor ligula, efficitur quis justo a, placerat tristique ipsum.',
        'Suspendisse potenti. Duis eu nisi lacus. Donec at sagittis eros. Donec lobortis neque ut pellentesque interdum. Nam nec aliquam dolor. Phasellus efficitur elit ac odio congue hendrerit. In faucibus leo ac condimentum tempus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Integer venenatis, mauris sit amet iaculis rutrum, lectus lorem tristique lacus, sit amet lacinia erat neque vel ipsum. Sed fringilla interdum metus vel vestibulum.',
        'Curabitur condimentum ullamcorper metus vel feugiat. Nulla facilisi. Cras accumsan id dui at semper. Curabitur iaculis ex id ligula tristique euismod et quis eros. Proin id leo sagittis, porta neque vitae, imperdiet lorem. Donec vel leo ut ante aliquet aliquam a eu risus. Nulla consectetur odio felis, et maximus risus dapibus vitae. Curabitur suscipit ultricies metus, eu scelerisque quam ultricies nec. Duis luctus est sapien, id auctor quam tristique id. Nullam nec viverra sem, at tristique velit. Quisque eu aliquet libero. Donec a molestie quam, vel scelerisque enim.',
        'Curabitur id magna ornare leo fermentum facilisis. Nulla suscipit euismod aliquam. Sed ac ultrices massa. Vivamus nisl ante, hendrerit in accumsan at, fermentum eget est. Donec pellentesque tincidunt augue, ac egestas urna vulputate eget. Phasellus porta nunc mauris, vel molestie enim aliquet nec. Maecenas et molestie nisl. Sed at enim at augue iaculis mollis. Maecenas eget malesuada orci. Duis sit amet convallis nisi. Nullam placerat nulla ipsum. Ut libero justo, pellentesque quis turpis at, iaculis molestie elit. Suspendisse at finibus tortor. Nam finibus, nibh at facilisis lobortis, est magna ullamcorper mi, a luctus felis urna quis lectus.',
        'Quisque volutpat justo eget ex rutrum tincidunt. Vivamus enim est, cursus sit amet purus vitae, cursus tincidunt ante. Donec venenatis, ligula eget rhoncus pretium, lacus lorem dapibus dolor, a porta mauris leo non nisl. Aenean sed dapibus leo, nec fermentum lorem. In quis dui facilisis, feugiat ipsum et, scelerisque mauris. Donec imperdiet malesuada orci. Vivamus sollicitudin, lectus vitae iaculis volutpat, diam magna imperdiet nisi, in commodo turpis velit non tortor. Vivamus tempus in sem nec tempor. Nulla egestas lacus in porttitor lobortis. Sed euismod egestas semper. Sed venenatis sodales posuere. Quisque volutpat tortor et est molestie aliquam. Curabitur tempor mauris quis purus cursus tempus. Vestibulum eget mi nec odio fermentum posuere ut at sem. Nam maximus, orci bibendum rutrum lobortis, mi velit tristique risus, vel luctus nisi neque eu lorem.',
        'Mauris molestie arcu a accumsan tristique. Sed enim lacus, euismod id interdum nec, porttitor at ex. Nulla eu enim sit amet diam scelerisque maximus. Integer faucibus iaculis interdum. In hac habitasse platea dictumst. Sed elementum, urna quis luctus malesuada, nisi odio imperdiet velit, non porttitor massa libero eleifend tellus. Vivamus in lorem vehicula, convallis purus tempus, egestas mauris. Curabitur sapien nunc, viverra at nisl id, consectetur volutpat felis. Duis sapien tortor, euismod in nisi sit amet, tincidunt aliquam nibh. Quisque feugiat quam sit amet vestibulum tincidunt. Sed eu magna id risus congue ultricies vel ut odio. Donec condimentum ligula sed lectus venenatis suscipit. Etiam neque metus, sagittis vitae faucibus eu, pellentesque pulvinar risus.',
        'Maecenas elementum velit ligula, ac tempus erat varius at. Etiam ultricies ligula ac metus condimentum, congue molestie lectus congue. Donec sapien eros, scelerisque eget laoreet vitae, convallis quis tortor. Mauris in ultrices nunc, eu eleifend nunc. Morbi elit justo, placerat non venenatis sed, tincidunt ac mi. Sed iaculis nisi leo, non hendrerit lorem aliquet vel. Duis a varius dui, et pretium ante. Duis elementum efficitur arcu tincidunt pretium. Vestibulum sed tortor at odio accumsan viverra euismod eget nulla. Nullam bibendum aliquam neque, a egestas sem porta eu. Proin sodales scelerisque lectus, porttitor consectetur ipsum sollicitudin sed. Sed non nunc rutrum mauris ultrices mattis. Suspendisse ut feugiat mi.',
        'Quisque nunc erat, pulvinar id ultrices eget, mattis ac lacus. Duis eleifend ipsum eget turpis fringilla, ac porta lorem finibus. Donec pharetra ex eget sem interdum, sit amet volutpat ligula pretium. Sed iaculis ornare velit non porttitor. Praesent sit amet pharetra erat, volutpat sodales metus. Praesent commodo enim sapien, ac fermentum dui sagittis eu. Phasellus convallis egestas interdum.',
        'Phasellus nec augue quam. Cras massa nisi, laoreet vel fermentum sit amet, dapibus non velit. Cras eget ligula eu tortor dignissim mattis id in ex. Vivamus vel ex eu velit hendrerit congue. Vivamus vel orci quis est commodo vestibulum at at lorem. Nam mollis nunc ut libero consequat, finibus gravida ipsum laoreet. Morbi aliquet dui lectus, ultricies faucibus nibh porta non. Ut bibendum odio nisl. Fusce ac arcu eu felis auctor tincidunt ac sit amet justo. Pellentesque fermentum lectus non mattis luctus.',
        'Cras fermentum, justo ac egestas commodo, dui enim pulvinar sapien, eget molestie quam tortor et tortor. Curabitur at nisi tincidunt, rutrum lectus ut, convallis turpis. Cras dignissim magna consequat pharetra dignissim. Suspendisse mattis sed diam ut porta. Fusce mi enim, scelerisque a lacus in, blandit rutrum magna. Nunc pretium augue ac ligula eleifend, ac faucibus justo semper. Etiam varius ultricies blandit. Mauris sollicitudin magna et ante pharetra bibendum. Fusce sed neque a arcu consectetur pellentesque.',
        'Ut hendrerit, neque et rutrum porttitor, urna purus dictum mi, nec accumsan lacus sapien vel magna. Sed finibus urna scelerisque, ultrices diam vel, ullamcorper est. Suspendisse eget sagittis neque, non hendrerit leo. Aliquam molestie tortor urna, eget mattis ipsum tristique in. Nunc tempus, nisl non tristique eleifend, nunc libero molestie eros, sed varius odio sapien sed eros. Morbi rutrum, ligula mattis imperdiet ultricies, urna leo congue neque, quis ultrices lacus magna at nunc. Suspendisse pellentesque viverra orci, quis dapibus felis bibendum in. Pellentesque felis dolor, hendrerit ut sem ac, iaculis ultrices sapien. Maecenas convallis tortor a urna ultricies luctus. Sed auctor sapien nec leo condimentum, id hendrerit urna faucibus. Etiam dapibus venenatis tristique. Etiam eget neque massa. Aliquam ornare, velit at maximus scelerisque, ipsum nibh feugiat sapien, et condimentum ante arcu vitae libero. Suspendisse ut tortor vitae nunc placerat placerat. Aenean vel feugiat orci.',
        'Aliquam vel purus a risus scelerisque placerat. Suspendisse potenti. Suspendisse potenti. In sit amet gravida nunc. Pellentesque quis eros vitae lectus mollis tincidunt eu eu metus. Nullam tincidunt sit amet lacus eu dictum. In hac habitasse platea dictumst.',
        'Maecenas mi augue, porttitor vitae diam sit amet, ultrices feugiat turpis. Donec scelerisque, felis sit amet ornare ornare, neque ante gravida leo, nec ullamcorper velit libero vel ex. Aenean tempus nec erat eu dictum. Mauris gravida auctor ante sed gravida. Integer pretium ipsum nec turpis elementum, auctor dictum justo pulvinar. Aliquam efficitur fermentum magna. Pellentesque sed ex nulla. Sed non semper urna.',
        'Cras venenatis erat justo, quis rutrum mauris venenatis non. Proin tincidunt, augue et vulputate scelerisque, lacus orci tempor lectus, et viverra leo nibh ut metus. Fusce turpis tortor, lacinia at est et, faucibus imperdiet magna. Integer nec luctus mi. Aenean nec laoreet velit. Curabitur vestibulum imperdiet nibh, sit amet ultricies erat lacinia sed. Sed sed posuere ipsum, ut semper sapien. Maecenas at dolor dolor. Maecenas laoreet, sem vel accumsan efficitur, turpis dui facilisis lorem, quis consequat augue nisi sit amet nunc. Etiam finibus nulla eu velit ultricies, ac gravida lectus lacinia. Cras ultrices consectetur imperdiet. Praesent et dui in neque imperdiet aliquam. Aliquam tempor velit nec orci tincidunt suscipit.',
        'Quisque non sem felis. Fusce commodo cursus purus eu maximus. Sed scelerisque rhoncus enim. Suspendisse fermentum elit in facilisis vestibulum. Aenean sed quam faucibus, tincidunt neque eu, blandit quam. Etiam eget lacus risus. Ut suscipit diam libero, eu lacinia est viverra vel. Ut tempor magna nibh, quis auctor diam mattis ac. Cras non neque tortor. Aliquam consectetur ante auctor augue facilisis aliquet. Aenean et nibh quis enim malesuada egestas nec eu enim. Cras vel lectus a eros luctus vestibulum a eu tortor. Suspendisse iaculis ligula libero, id fringilla justo suscipit non. Nam eu tristique libero, consectetur luctus tellus. Suspendisse nec commodo erat, sit amet maximus metus.',
        'Nam at molestie lacus. Sed sit amet ex vulputate metus laoreet blandit eget vel turpis. Sed lectus erat, feugiat in malesuada in, interdum ac lectus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nam condimentum urna quis libero interdum placerat. Fusce pellentesque, ipsum non feugiat volutpat, urna sapien blandit massa, eu lobortis libero erat sit amet sem. Integer rutrum arcu libero, convallis molestie justo interdum id. Donec tempor efficitur dui eget lobortis. Ut ut justo id magna laoreet accumsan. Vivamus velit nulla, rutrum nec nisi vel, luctus pharetra dui. Fusce dictum et leo vel elementum. Donec non enim quis purus volutpat faucibus. Praesent condimentum condimentum lectus, in euismod magna auctor sed. Duis varius eros nec augue venenatis accumsan. ',
    );
    protected $array_event = array(
        "Carnaval",
        "City Salsa Party",
        "Salsa Birthday",
        "Love night bachata",
        "Nuits latines",
        "la Clave",
        "Salsa Eve",
        "The kiz & kiss",
        "Salsa for you",
        "National Salsa days",
        "Time To Salsa",
        "Dance salsa for ever event",
        "Carnaval 2",
        "City Salsa Party 2",
        "Salsa Birthday 2",
        "Love night bachata 2",
        "Nuits latines 2",
        "la Clave 2",
        "Salsa Eve 2",
        "The kiz & kiss 2",
        "Salsa for you 2",
        "National Salsa days 2",
        "Time To Salsa 2",
        "Dance salsa for ever event 2",
        "Sooooo Kiz",
        "Guachineo night",
        "Salsa Diner",
        "Merengue Birthday",
        "Ambiance Salsa",
        "Ambiance Kizomba",
        "Tango 4 ever",
        "Milonga day",
        "Concierto Latino",
        "Bailar Bailar y Bailar",
        "Rueda Party",
        "Rueda de cuba",
        "Rueda con Timba",
        "soirée zouk",
        "Zouk & fun",
        "Sooooo Kiz v2",
        "Guachineo night v2",
        "Salsa Diner v2",
        "Merengue Birthday v2",
        "Ambiance Salsa v2",
        "Ambiance Kizomba v2",
        "Tango 4 ever v2",
        "Milonga day v2",
        "Concierto Latino v2",
        "Bailar Bailar y Bailar v2",
        "Rueda Party v2",
        "Rueda de cuba v2",
        "Rueda con Timba v2",
        "soirée zouk v2",
        "Zouk & fun v2",
    );
    protected $array_city = array(
        'paris',
        'lille',
        'singapore',
        'pekin',
        'san_francisco',
        'new_york',
        'budapest',
    );
    protected $array_eventfile = array(
        1 => '1.jpg',
        2 => '2.jpg',
        3 => '3.jpeg',
        4 => '4.jpg',
        5 => '5.jpg',
        6 => '6.jpg',
        7 => '7.jpg',
        8 => '8.jpg',
        9 => '9.jpg',
        10 => '10.jpg',
        11 => '11.jpg',
        12 => '12.jpg',
        13 => '13.jpg',
        14 => '14.jpg',
        15 => '15.jpg',
        16 => '16.jpg',
        17 => '17.jpg',
        18 => '18.jpg',
        19 => '19.jpg',
        20 => '20.jpg',
        21 => '21.jpg',
        22 => '22.jpg',
        23 => '23.jpg',
    );
    protected $array_music = array(
        'https://soundcloud.com/peter-benjamin/marc-anthony-ahora-quien',
        'http://open.spotify.com/artist/5lsC3H1vh9YSRQckyGv0Up',
        'https://soundcloud.com/djnico-1/salsa-mix',
        'https://soundcloud.com/salsard/roby-peralta-yo-quiero-amarte-salsardcom2015',
        'https://soundcloud.com/sh-il-c-br-r/salsa-mix-para-bailar-rom',
        'https://open.spotify.com/track/0CSJp9bSIhAQ1J8uHTHebu',
        'https://open.spotify.com/track/7CsYHK2xk1n71pJr9geL1t',
        'https://open.spotify.com/track/5zGr7pFHaQI5f3TzhOXMKT',
        'https://open.spotify.com/track/5DO5ISJdDK2SluTCAEW1oS',
        'https://open.spotify.com/track/3Pacy6CMa8HPNVfeA3wkPQ',
        'https://open.spotify.com/track/5BwRO8sd8esywd8C7jsgIF',
        'https://open.spotify.com/track/2kKAtPzW5ulCuvfshjWNo6',
        'https://open.spotify.com/track/2HPneOQ0cxaIQbICMvvGED',
    );
    protected $array_userfile = array(
        1 => '1.jpg',
        2 => '2.jpg',
        3 => '3.jpg',
        4 => '4.jpg',
        5 => '5.jpg',
        6 => '6.jpg',
        7 => '7.jpg',
        8 => '8.jpg',
        9 => '9.jpg',
        10 => '10.jpg',
        11 => '11.jpg',
        12 => '12.jpg',
        13 => '13.jpg',
        14 => '14.jpg',
        15 => '15.jpg',
        16 => '16.jpg',
        17 => '17.jpg',
        18 => '18.jpg',
        19 => '19.jpg',
        20 => '20.jpg',
        21 => '21.jpg',
        22 => '22.jpg',
        23 => '23.jpg',
        24 => '24.jpg',
        25 => '25.jpg',
        26 => '26.jpg',
        27 => '27.jpg',
        28 => '28.jpg',
        29 => '29.jpg',
        30 => '30.jpg',
        31 => '31.jpg',
        32 => '32.jpeg',
        33 => '33.jpg',
        34 => '34.jpg',
        35 => '35.jpeg',
        36 => '36.jpg',
        37 => '37.jpg',
    );
    protected $array_userfile_bar = array(
        1 => '1.jpg',
        2 => '2.jpg',
        3 => '3.jpg',
        4 => '4.jpg',
        5 => '5.jpg',
        6 => '6.jpg',
        7 => '7.jpg',
        8 => '8.jpg',
        9 => '9.jpg',
        10 => '10.jpg',
        11 => '11.jpg',
        12 => '12.jpg',
        13 => '13.jpg',
        14 => '14.jpg',
        15 => '15.jpg',
        16 => '16.jpg',
        17 => '17.png',
        18 => '18.jpg',
        19 => '19.jpg',
    );
    protected $array_video = array(
        'https://www.youtube.com/watch?v=4P7V5yaQnmc',
        'https://vimeo.com/2374758',
        'http://www.dailymotion.com/video/x24ptwt_el-rubio-loco-libre-salsa_music',
        'https://www.youtube.com/watch?v=aVtWSZOttC0',
        'https://www.youtube.com/watch?v=6DWhBCofTCo',
        'https://www.youtube.com/watch?v=aV8dS2m9Adc',
        'https://www.youtube.com/watch?v=YXnjy5YlDwk',
        'https://www.youtube.com/watch?v=toLrTToaN0M',
        'https://www.youtube.com/watch?v=VMp55KH_3wo',
        'https://vimeo.com/109276707',
        'https://vimeo.com/127828813',
        'https://www.youtube.com/watch?v=AiUlNbF6-Ok',
    );

    public function __construct() {
        $this->array_user = array_merge(
                $this->array_user_artist, $this->array_user_teacher, $this->array_user_dancer, $this->array_user_bar
        );
    }

}
