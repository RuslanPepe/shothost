const input = document.getElementById('formFileMultiple');
const preview = document.getElementById('preview');
// const access = new FormData(document.getElementById('SettingsLink')).get('access');
// const passwordBlock = document.getElementById('passwordBlock')

let files = [];
let Form = new FormData;

window.addEventListener('resize', updateArrows);

function CheckAccess() {
    const access = new FormData(document.getElementById('SettingsLink')).get('access');
    const passwordBlock = document.getElementById('passwordBlock')


    passwordBlock.style.display = access === 'password' ? '' : 'none'

    console.log(passwordBlock.style.display)
}

['access1', 'access2', 'access3'].forEach((id)=>{
    document.getElementById(id).addEventListener('input', () => CheckAccess())
})

// document.getElementById('access1').addEventListener('input', () => CheckAccess())
// document.getElementById('access2').addEventListener('input', () => CheckAccess())
// document.getElementById('access3').addEventListener('input', () => CheckAccess())


document.getElementById('createLinks').addEventListener('click', ()=>CreateLink())

input.addEventListener('change', function () {

    Array.from(this.files).forEach(file => {

        file.url = URL.createObjectURL(file);
        files.push(file);

        const wrapper = document.createElement('div');
        wrapper.classList.add("wrapper");

        const img = document.createElement('img');
        img.src = file.url;
        img.dataset.index = files.length - 1;
        img.addEventListener("click", () => addPhotoBlock(file, Number(img.dataset.index)));
        img.classList.add("img");

        const removeBtn = document.createElement('button');
        removeBtn.innerHTML = "✕";
        removeBtn.classList.add("removeBtn");

        removeBtn.onclick = () => {
            const index = files.indexOf(file)
            files.splice(index, 1)
            wrapper.remove();

            document.querySelectorAll('.img').forEach((img, i) => {
                img.dataset.index = i;
            })

            updateArrows();
        };

        wrapper.appendChild(img);
        wrapper.appendChild(removeBtn);

        preview.appendChild(wrapper);
        updateArrows();

    });

    setTimeout(updateArrows, 0);
});

document.getElementById("scrollLeft").addEventListener("click", () => {
    preview.scrollBy({left: -preview.clientWidth, behavior: 'smooth'});
});

document.getElementById("scrollRight").addEventListener("click", () => {
    preview.scrollBy({left: preview.clientWidth, behavior: 'smooth'});
});


function updateArrows() {
    const arrows = document.querySelectorAll('.arrow');
    const wrappers = preview.querySelectorAll('.wrapper');
    let totalWidth = 0;

    wrappers.forEach(w => {
        totalWidth += w.offsetWidth + 10;
    });

    if (totalWidth > preview.clientWidth) {
        arrows.forEach(a => a.style.display = 'flex');
    } else {
        arrows.forEach(a => a.style.display = 'none');
    }
}


function addPhotoBlock(file, index) {
    const container = document.getElementById('photoContainer');

    document.body.style.overflow = 'hidden';

    // Создаём главный блок
    const block = document.createElement('div');
    block.className = 'ShowPhotoBlock';
    block.id = 'ShowPhotoBlock';

    block.addEventListener('click', (e) => {
        if (e.target === block) { // если кликнули на overlay, а не на саму картинку или кнопки
            block.remove();
            document.body.style.overflow = '';
        }
    });

    // Кнопка влево
    const leftBtn = document.createElement('button');
    leftBtn.className = 'arrowImg leftImg';
    leftBtn.id = 'scrollLeftImg';
    leftBtn.textContent = '‹';
    leftBtn.addEventListener('click', () => SwipeLeft());
    block.appendChild(leftBtn);

    // image src
    const img = document.createElement('img');
    img.src = file.url; // путь к картинке
    img.className = 'ShowPhotoImg';
    img.dataset.index = index;
    block.appendChild(img);

    grabImg(img);
    scalePhoto(img);

    // Кнопка вправо
    const rightBtn = document.createElement('button');
    rightBtn.className = 'arrowImg rightImg';
    rightBtn.id = 'scrollRightImg';
    rightBtn.textContent = '›';
    rightBtn.addEventListener('click', () => SwipeRight());
    block.appendChild(rightBtn);

    // Счётчик
    const countDiv = document.createElement('div');
    countDiv.className = 'count';
    countDiv.id = 'count';
    countDiv.textContent = `${Number(index) + 1} из ${files.length}`;
    block.appendChild(countDiv);

    // Close Show
    const closeShow = document.createElement('button');
    closeShow.className = 'closeBtn';
    closeShow.textContent = "✕";
    closeShow.addEventListener('click', () => {
        const el = document.getElementById('ShowPhotoBlock');
        if (el) {
            el.remove();
            document.body.style.overflow = '';
        }
    });
    block.appendChild(closeShow);

    // Имя файла
    const fileNameDiv = document.createElement('div');
    fileNameDiv.className = 'fileName';
    fileNameDiv.id = 'fileName';
    // Берём только имя файла из пути
    fileNameDiv.textContent = `File name: ${file.name}`;
    block.appendChild(fileNameDiv);

    // Добавляем в контейнер
    container.appendChild(block);
}

function getViewer() {
    return {
        PhotoIMG: document.querySelector('.ShowPhotoImg'),
        Count: document.getElementById('count'),
        fileName: document.getElementById('fileName')
    }
}

function SwipeRight() {
    const {PhotoIMG, Count, fileName} = getViewer();
    let id = Number(PhotoIMG.dataset.index);

    if (id < files.length - 1) {
        PhotoIMG.src = files[id + 1].url;
        Count.textContent = `${id + 2} из ${files.length}`;
        PhotoIMG.dataset.index = id + 1;
        fileName.textContent = `File name: ${files[id + 1].name}`;
    }
}

function SwipeLeft() {
    const {PhotoIMG, Count, fileName} = getViewer();
    let id = Number(PhotoIMG.dataset.index);

    if (id > 0) {
        PhotoIMG.src = files[id - 1].url;
        Count.textContent = `${id} из ${files.length}`;
        PhotoIMG.dataset.index = id - 1;
        fileName.textContent = `File name: ${files[id - 1].name}`;
    }
}

function scalePhoto(img) {
    let scale = 1;

    img.addEventListener('wheel', (e) => {
        e.preventDefault(); // отключаем прокрутку страницы
        if (e.deltaY < 0) { // колесо вверх → увеличить
            scale += 0.1;
        } else { // колесо вниз → уменьшить
            scale -= 0.1;
        }
        scale = Math.min(Math.max(0.5, scale), 3); // ограничение от 0.5x до 3x
        img.style.transform = `scale(${scale})`;
    });
}


function grabImg(img) {
    // Глобальные переменные для текущего фото
    let currentImg = null;
    let scale = 1;
    let posX = 0, posY = 0;
    let startX = 0, startY = 0;
    let isDragging = false;

    currentImg = img;
    currentImg.style.cursor = 'grab';

    // Drag
    currentImg.addEventListener('mousedown', (e) => {
        e.preventDefault();
        isDragging = true;
        startX = e.clientX - posX;
        startY = e.clientY - posY;
        currentImg.style.cursor = 'grabbing';
    });

    // События на window
    window.addEventListener('mousemove', (e) => {
        if (!isDragging || !currentImg) return;

        let newX = e.clientX - startX;
        let newY = e.clientY - startY;

        // ограничения
        const maxX = currentImg.offsetWidth * 0.5 * scale;  // ±50% ширины
        const maxY = window.innerHeight * 0.4;             // ±30% высоты

        posX = Math.min(Math.max(newX, -maxX), maxX);
        posY = Math.min(Math.max(newY, -maxY), maxY);

        currentImg.style.transform = `translate(${posX}px, ${posY}px) scale(${scale})`;
    });

    window.addEventListener('mouseup', () => {
        if (currentImg) currentImg.style.cursor = 'grab';
        isDragging = false;
    });

    // Zoom
    window.addEventListener('wheel', (e) => {
        if (!currentImg) return;
        e.preventDefault();
        const delta = e.deltaY > 0 ? -0.1 : 0.1;
        scale = Math.min(Math.max(scale + delta, 0.5), 3);

        currentImg.style.transform = `translate(${posX}px, ${posY}px) scale(${scale})`;
    }, { passive: false });


    window.addEventListener('keydown', (e) => {
        if (e.key === "Escape") {
            const block = document.getElementById('ShowPhotoBlock');
            if (block) {
                block.remove();
                document.body.style.overflow = '';
            }
        }
    });
}

function CreateLink() {
    Form = new FormData(document.getElementById('SettingsLink'))
    files.forEach((file) => {
        Form.append('image[]', file);
    })
    // Form.append('lifetime', 1);
    // Form.append('access', 'link');
    // Form.append('deleteAfter', 0);
    // Form.append('typeAccess', 'onlyView');
    // Form.append('Title', 123);
    // Form.append('Description', 2);
    // Form.append('CustomLink', '2');

    fetch('/createLink', {
        method: 'POST',
        headers: {
            // 'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: Form
    })
        .then(res => res.json())
        .then(data => console.log(data))
        .catch(err => console.error(err));
}
