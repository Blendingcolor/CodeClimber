// Script para mostrar/ocultar submódulos 
    // Función para mostrar/ocultar submódulos al hacer clic en los botones
    document.querySelectorAll('.module-button').forEach(button => {
        button.addEventListener('click', () => {
            const target = button.getAttribute('data-target');
            const submodule = document.getElementById(target);
            const submoduleContent = document.getElementById('submodule-content');

            // Ocultar todos los submódulos
            document.querySelectorAll('[id^="submodule-"]').forEach(sub => {
                if (sub.id !== target) {
                    sub.classList.add('hidden');
                }
            });

            // Mostrar/ocultar el submódulo seleccionado
            submodule.classList.toggle('hidden');
            submoduleContent.classList.toggle('hidden');
        });
    });

    const closeSectionButton = document.querySelector('#closeSectionButton');
    const coursesSection = document.querySelector('#coursesSection');
    const contentSection = document.querySelector('#contentSection');
    let closed = false;

    //Función para cerrar la sección de módulos

    const whenClickOpenButton = () => {
        coursesSection.classList.toggle('-translate-x-full');
        closeSectionButton.classList.toggle('rotate-180');
        setTimeout(() => {
            closeSectionButton.classList.toggle('translate-x-1');
            coursesSection.classList.toggle('hidden');
            contentSection.classList.toggle('col-span-2');
            contentSection.classList.toggle('col-span-full');
        }, 150);
        closed = false;
    };

    //Función para abrir la sección de módulos
    const whenClickCloseButton = () => {
        coursesSection.classList.toggle('-translate-x-full');
        closeSectionButton.classList.toggle('rotate-180');
        setTimeout(() => {
            closeSectionButton.classList.toggle('translate-x-1');
            coursesSection.classList.toggle('hidden');
            contentSection.classList.toggle('col-span-2');
            contentSection.classList.toggle('col-span-full');
        }, 150);
        closed = true;
    };
    // Evento para mostrar/ocultar el menú de módulos

    closeSectionButton.addEventListener('click', () => {
        if (closed) {
            whenClickOpenButton();
        } else {
            whenClickCloseButton();
        }
    });

    // Lógica para cambiar y reproducir audio
    const audioButton = document.getElementById('audio-button');
    const audioIcon = document.getElementById('audio-icon');
    let audioPlaying = false;
    const audios = [
        new Audio('ruta/al/audio1.mp3'),
        new Audio('ruta/al/audio2.mp3')
    ];
    let currentAudio = 0;

    audioButton.addEventListener('click', () => {
        if (audioPlaying) {
            audios[currentAudio].pause();
            audioIcon.src = asset('images/icons/audioOff.svg');
        } else {
            audios[currentAudio].play();
            audioIcon.src = asset('images/icons/audioOn.svg');
            currentAudio = (currentAudio + 1) % audios.length;
        }
        audioPlaying = !audioPlaying;
    });

    // Lógica para la ventana emergente de video
    const videoButton = document.getElementById('video-button');
    const videoPopup = document.getElementById('video-popup');
    const closePopup = document.getElementById('close-popup');

    videoButton.addEventListener('click', () => {
        videoPopup.style.display = 'block';
        videoPopup.style.backgroundColor = rgba(255, 255, 255,0.5)
    });

    closePopup.addEventListener('click', () => {
        videoPopup.style.display = 'none';
    });



    
    
// const modulesSectionWhenAppear = [
//      "absolute", "w-full", "col-span-full", "justify-center", "items-center", "top-2/4", "left-2/4",
//      "-translate-x-2/4", "-translate-y-2/4", "w-3/4", "bg-black", "bg-opacity-85", "p-10", "z-20"
//  ];

//  const whenClickCloseButton = () => {
//      sectionButton.src = "{{ asset('images/icons/openSection.svg') }}";
//      mainContent.classList.remove('col-span-1');
//      mainContent.classList.add('col-span-2');
//      modulesSection.classList.add('hidden');
//      iconAction = true;
//  };

//  const whenClickOpenButton = () => {
//      sectionButton.src = "{{ asset('images/icons/closeSection.svg') }}";
//      mainContent.classList.remove('col-span-2');
//      mainContent.classList.add('col-span-1');
//      modulesSection.classList.remove('hidden');
//      iconAction = false;
//  };

//  Función para mostrar/ocultar el menú de módulos en pantallas pequeñas
//  const toggleModulesSectionNoMedia = () => {
//      if (!iconAction) {
//          whenClickCloseButton();
//      } else {
//          whenClickOpenButton();
//      }
//  };

//  Función para mostrar/ocultar el menú de módulos en pantallas grandes
//  const toggleModulesSectionMedia = () => {
//      if (!iconAction) {
//          sectionButton.src = "{{ asset('images/icons/openSection.svg') }}";
//          modulesSection.classList.remove('lg:hidden');
//          modulesSection.classList.add(...modulesSectionWhenAppear);
//          modulesSection.children[1].classList.add("w-3/4");
//          iconAction = true;
//      } else {
//          sectionButton.src = "{{ asset('images/icons/closeSection.svg') }}";
//          modulesSection.classList.add('lg:hidden');
//          modulesSection.classList.remove(...modulesSectionWhenAppear);
//          iconAction = false;
//      }
//  };

//  const handleResize = () => {
//      if (window.matchMedia("(max-width: 950px)").matches) {
//          sectionButton.src = "{{ asset('images/icons/openSection.svg') }}";
//          sectionButton.removeEventListener('click', toggleModulesSectionMedia);
//          sectionButton.addEventListener('click', toggleModulesSectionNoMedia);
//      } else {
//          sectionButton.src = "{{ asset('images/icons/closeSection.svg') }}";
//          sectionButton.removeEventListener('click', toggleModulesSectionNoMedia);
//          sectionButton.addEventListener('click', toggleModulesSectionMedia);
//      }
//  };

//  handleResize();

//  window.addEventListener('resize', handleResize); 
