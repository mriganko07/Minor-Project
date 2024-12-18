<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.7/dist/full.css" rel="stylesheet" type="text/css" />
    <style>
    /* Custom CSS for responsive adjustments */
    @media (max-width: 768px) {
        .content {
            height: 100vh;
            margin-top: 100vh;
        }

        .card-container {
            display: grid;
            grid-template-columns: 1fr;
        }

        .responsive-card {
            width: 100%;
            margin: 0 0 20px;
            /* Add some margin between the cards */
        }
    }
    </style>
</head>

<body>
    <div id="content" class="h-[80vh] w-full flex  justify-center sm:items-center">
        <div class="flex justify-between items-center w-full m-10 rounded-md card-container">
            <div class="responsive-card w-1/2 m-10 rounded-md bg-slate-400 shadow-xl">
                <div class="card lg:card-side bg-slate-400">
                    <figure class="h-52 w-52">
                        <img src="https://images.unsplash.com/photo-1518976024611-28bf4b48222e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1885&q=80"
                            alt="Album" class="max-w-md h-full w-full" />
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title text-black">All Courses</h2>
                        <p class="text-black">
                            Click the button to view all the Courses.
                        </p>
                        <div class="card-actions justify-end">
                            <button class="btn btn-primary" id="students-btn"
                                onclick="window.location.href='courses.php'">
                                Add Courses
                            </button>

                        </div>
                    </div>
                </div>
            </div>
            <div class="responsive-card w-1/2 m-10 rounded-md bg-slate-400 shadow-xl">
                <div class="card lg:card-side bg-slate-400">
                    <figure class="h-52 w-52">
                        <img src="https://images.unsplash.com/photo-1518976024611-28bf4b48222e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1885&q=80"
                            alt="Album" class="max-w-md h-full w-full" />
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title text-black">All Students</h2>
                        <p class="text-black">
                            Click the button to view all the Students.
                        </p>
                        <div class="card-actions justify-end">
                            <button class="btn btn-primary" id="students-btn"
                                onclick="window.location.href='ViewStudents.php'">
                                View Students
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>