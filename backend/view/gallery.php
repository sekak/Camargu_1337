<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-y..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: sans-serif;
        }

        .home {
            display: flex;
            min-height: 100vh;
        }

        .sidebar_home {
            width: 250px;
            padding: 20px;
        }

        .main-content {
            flex: 1;
            padding: 20px;
            margin-top: 80px;
            width: calc(100% - 250px);
        }

        .main-content h1 {
            font-size: 2rem;
            margin-bottom: 20px;
            padding: 0px 20px;
        }

        .gallery-container {
            display: flex;
            gap: 10px;
        }

        .gallery {
            flex: 4;
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 10px;
            padding: 20px;
            overflow: hidden;
        }

        .thumbnail {
            flex: 1;
            height: calc(100vh - 200px);
        }

        .thumbnail h2 {
            font-size: 1.2rem;
        }

        .thubmnail-images {
            height: 100%;
            overflow-y: scroll;
        }

        .thubmnail-images img {
            width: 100%;
            height: auto;
            object-fit: cover;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .img-container {
            width: 100%;
            display: flex;
            gap: 20px;
        }

        .img-wrapper {
            position: relative;
            width: 80%;
            height: 450px;
            border: 1px solid #ccc;
            border-radius: 20px;
        }

        .img-wrapper .superpose {
            position: absolute;
            top: 0;
            left: 0;
            z-index: 1;
            pointer-events: none;
            opacity: 0.3;
            display: 'none';
        }

        .img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 20px;
        }

        .img-btn {
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: 20%;
        }

        .img-btn button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
        }

        .img-btn label {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            border: 1px solid #ccc;
            text-align: center;
        }


        .superpose-img {
            display: flex;
            margin-top: 80px;
        }

        .superpose-img-item {
            display: flex;
            flex-wrap: nowrap;
            gap: 10px;
            overflow-x: auto;
            overflow-y: hidden;
            width: 100%;
            padding: 10px 0;
        }

        .superpose-img img {
            width: 100px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            object-fit: cover;
        }


        .superpose-img img {
            width: 100px;
            height: 100px;
        }

        .preview-image,
        .video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 20px;
            display: none;
        }

        .superpose {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 20px;
        }

        @media (max-width: 920px) {
            .sidebar_home {
                width: 150px;
            }
        }

        @media (max-width: 624px) {
            .sidebar_home {
                width: 50px;
            }
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <?php include_once("./includes/navbar.php"); ?>

    <!-- Page Layout -->
    <main class="home">
        <!-- Sidebar -->
        <div class="sidebar_home">
            <?php include_once("./includes/sidebar.php"); ?>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <h1>Create Your Image</h1>
            <div class="gallery-container">
                <div class="gallery">
                    <div class="img-container">
                        <div class="img-wrapper">
                            <img id="previewImage" src="" alt="Image Preview" class="preview-image" />
                            <video id="captureImage" autoplay class="video" playsinline></video>
                        </div>
                        <div class="img-btn">
                            <button id="capture-btn">Capture</button>
                            <button id="start-camera-btn">Start Camera</button>
                            <label id="label-avatar" for="avatar" class="btn">Upload</label>
                            <input type="file" id="avatar" name="avatar" accept="image/png, image/jpeg"
                                style="display: none;" />
                        </div>
                    </div>
                    <div class="superpose-img" id="superpose-img">
                        <div class="superpose-img-item" id="superpose-img-item">
                            <img src="/public/img1.jpeg" alt="Superposed Image 1" id="ticket" />
                            <img src="/public/img2.jpeg" alt="Superposed Image 1" id="ticket" />
                        </div>
                    </div>
                </div>
                <div class="thumbnail">
                    <h2>Previous Creations</h2>
                    <div class="thubmnail-images">
                        <img src="https://picsum.photos/600/400?random=3" alt="Thumbnail 1" />
                        <img src="https://picsum.photos/600/400?random=3" alt="Thumbnail 1" />
                        <img src="https://picsum.photos/600/400?random=3" alt="Thumbnail 1" />
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer style="text-align:center; padding:1rem; background:#eee;">Footer</footer>


    <script>
        window.addEventListener('DOMContentLoaded', () => {
            let isSuperposed = [];
            let saveBtn = null;
            let cancelBtn = null;

            const uploadBtn = document.getElementById('avatar');
            const previewImage = document.getElementById('previewImage');
            const captureBtn = document.getElementById('capture-btn');
            const startCameraBtn = document.getElementById('start-camera-btn');
            const video = document.getElementById('captureImage');
            const superposeImages = document.querySelectorAll('#ticket');
            const superposeImageItem = document.getElementById('superpose-img-item');
            const superposeImg = document.getElementById('superpose-img');
            const avatarLabel = document.getElementById('label-avatar');

            captureBtn.style.display = 'none';
            superposeImageItem.style.pointerEvents = 'none';
            superposeImg.style.cursor = 'not-allowed';

            function stopCamera() {
                if (video.srcObject) {
                    video.srcObject.getTracks().forEach(track => track.stop());
                }
            }

            function resetSuperposedImages() {
                isSuperposed.forEach(id => {
                    const img = document.getElementById(id);
                    if (img) img.remove();
                });
                isSuperposed = [];
                captureBtn.style.display = 'none';
            }

            function removeSaveBtn() {
                if (saveBtn) {
                    saveBtn.remove();
                    saveBtn = null;
                }
            }

            superposeImages.forEach(superpose => {
                superpose.addEventListener('click', () => {
                    const idName = `${superpose.src.split('/').pop().split('.')[0]}`;
                    const existingImg = document.getElementById(idName);

                    if (existingImg) {
                        existingImg.remove();
                        isSuperposed = isSuperposed.filter(item => item !== idName);
                        if (isSuperposed.length === 0) captureBtn.style.display = 'none';
                        return;
                    }

                    const img = document.createElement('img');
                    img.src = superpose.src;
                    img.classList.add('superpose');
                    img.id = idName;

                    video.insertAdjacentElement('afterend', img);
                    isSuperposed.push(idName);
                    captureBtn.style.display = 'inline-block';
                });
            });

            uploadBtn.addEventListener('change', (e) => {
                if (e.target.files.length === 0 || !previewImage) return;

                if (!cancelBtn) {
                    cancelBtn = document.createElement('button');
                    cancelBtn.textContent = 'Cancel Upload';
                    uploadBtn.insertAdjacentElement('afterend', cancelBtn);

                    cancelBtn.addEventListener('click', () => {
                        previewImage.src = '';
                        previewImage.style.display = 'none';
                        video.style.display = 'none';
                        uploadBtn.value = '';
                        startCameraBtn.style.display = 'inline-block';
                        cancelBtn.remove();
                        cancelBtn = null;
                        avatarLabel.style.display = '';

                        superposeImageItem.style.pointerEvents = 'none';
                        superposeImg.style.cursor = 'not-allowed';
                        resetSuperposedImages();
                        stopCamera();
                        removeSaveBtn();
                    });
                }

                const imgURL = URL.createObjectURL(e.target.files[0]);
                previewImage.src = imgURL;
                previewImage.style.display = 'block';
                video.style.display = 'none';
                startCameraBtn.style.display = 'none';
                avatarLabel.style.display = 'none';

                superposeImageItem.style.pointerEvents = 'fill';
                superposeImg.style.cursor = 'pointer';
                stopCamera();

                removeSaveBtn();
            });

            startCameraBtn.addEventListener('click', () => {
                avatarLabel.style.display = 'none';
                startCameraBtn.style.display = 'none';
                previewImage.style.display = 'none';
                video.style.display = 'block';

                navigator.mediaDevices.getUserMedia({ video: true })
                    .then((stream) => {
                        video.srcObject = stream;

                        superposeImageItem.style.pointerEvents = 'fill';
                        superposeImg.style.cursor = 'pointer';

                        if (!cancelBtn) {
                            cancelBtn = document.createElement('button');
                            cancelBtn.textContent = 'Cancel Camera';
                            uploadBtn.insertAdjacentElement('afterend', cancelBtn);

                            cancelBtn.addEventListener('click', () => {
                                stopCamera();
                                video.style.display = 'none';
                                previewImage.style.display = 'none';
                                startCameraBtn.style.display = 'inline-block';
                                cancelBtn.remove();
                                cancelBtn = null;
                                avatarLabel.style.display = '';

                                superposeImageItem.style.pointerEvents = 'none';
                                superposeImg.style.cursor = 'not-allowed';
                                resetSuperposedImages();
                                removeSaveBtn();
                            });
                        }
                    })
                    .catch((error) => {
                        console.error('Error accessing webcam:', error);
                    });
            });

            captureBtn.addEventListener('click', () => {
                const canvas = document.createElement('canvas');
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                const ctx = canvas.getContext('2d');
                ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
                
                previewImage.style.display = 'block';
                video.style.display = 'none';
                stopCamera();
                captureBtn.style.display = 'none';

                if (!saveBtn) {
                    saveBtn = document.createElement('button');
                    saveBtn.textContent = 'Save';
                    uploadBtn.insertAdjacentElement('afterend', saveBtn);
                }
                saveBtn.style.display = 'inline-block';
            });
        });



    </script>
</body>

</html>