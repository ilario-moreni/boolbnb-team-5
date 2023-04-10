@extends('layouts.app')
@section('content')
    <section id="jumbo">
        <div class="container my-5">
            <div class="row p-4">
                <div class="col-12">
                    <div class="content">
                        <h1>Apri un Airbnb.</h1>
                        <div class="star-line">
                            <span class="outer-line"></span>
                            <span><i class="fa-solid fa-star"></i></span>
                            <span class="outer-line"></span>
                        </div>
                        <p class="text-md-center">
                            Con Airbnb Start, mettere casa su Airbnb è facile
                        </p>
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-md-4 col-12 text-md-center">
                    <h3>Ricevi supporto individuale da un Superhost</h3>
                    <p>
                        Ti metteremo in contatto con un Superhost della tua zona, che ti guiderà dalla prima domanda al
                        primo
                        ospite tramite telefono, videochiamata o chat.
                    </p>
                </div>
                <div class="col-md-4 col-12 text-md-center">
                    <h3>Un ospite esperto per la tua prima prenotazione</h3>
                    <p>
                        Per la tua prima prenotazione, puoi decidere di accogliere un ospite esperto che vanta almeno tre
                        soggiorni e una serie di recensioni positive su Airbnb.
                    </p>
                </div>
                <div class="col-md-4 col-12 text-md-center">
                    <h3>Supporto Airbnb specializzato</h3>
                    <p>
                        In caso di problemi, ad esempio con l'account o la fatturazione, i nuovi host possono accedere con
                        un solo clic agli agenti del Community support, che sono stati appositamente formati per aiutarti.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container my-3 mb-5">
            <div class="row">
                <div class="col-6 d-none d-lg-block">
                    <h1 class="green_text">
                        Le risposte alle tue domande
                    </h1>
                </div>
                <div class="col-12 col-lg-6">
                    <h1 class="d-block d-lg-none green_text"> Le risposte alle tue domande </h1>
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item border-0 border-bottom">
                            <div class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <div class="fs-5">Il mio alloggio è adatto a Airbnb?</div>
                                </button>
                            </div>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Gli ospiti Airbnb sono interessati a tutti i tipi di alloggi. Abbiamo annunci per
                                    minicase, baite, case sull'albero e altro ancora. Anche una stanza in più può essere
                                    un'ottima soluzione per un soggiorno.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0 border-bottom">
                            <div class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                    <div class="fs-5">La disponibilità del mio alloggio deve essere costante?</div>
                                </button>
                            </div>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Assolutamente no: hai tu il controllo totale sul tuo calendario. Puoi affittare il tuo
                                    spazio una volta all'anno, qualche notte al mese o più spesso.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item border-0 border-bottom">
                            <div class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <div class="fs-5">Quanto dovrei interagire con gli ospiti?</div>
                                </button>
                            </div>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Sei tu a decidere. Alcuni host scelgono di inviare messaggi agli ospiti solo nei momenti
                                    importanti, e ricorrono ad esempio a una breve nota al check-in, mentre altri
                                    preferiscono incontrare di persona chi accolgono. Troverai certamente uno stile che si
                                    adatti sia a te che agli ospiti.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0">
                            <div class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    <div class="fs-5">Qualche consiglio su come essere un ottimo host Airbnb?</div>
                                </button>
                            </div>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Una volta capito come gestire gli aspetti essenziali, la strada è tutta in discesa.
                                    Tieni pulito l'alloggio, rispondi prontamente agli ospiti e fornisci i servizi
                                    necessari, come gli asciugamani puliti. Ad alcuni host piace aggiungere un tocco
                                    personale, ad esempio collocando dei fiori freschi nella sistemazione o condividendo un
                                    elenco di mete locali da esplorare, ma non è affatto obbligatorio farlo.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
