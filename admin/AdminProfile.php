<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Profile</title>
    <link
      href="https://cdn.jsdelivr.net/npm/daisyui@3.7.7/dist/full.css"
      rel="stylesheet"
      type="text/css" />
  </head>
  <body class="bg-stone-200 sm:overflow-y-hidden">
    <div
        class="fixed inset-0 flex items-center justify-center z-50 bg-gray-700 bg-opacity-50 text-black">
    <main class="h-screen flex items-center justify-center">
      <div
        class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10 bg-slate-400 rounded-md">
        <div class="mx-auto max-w-270">
          <div class="flex justify-between">
            <div
              class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
              <h2 class="text-title-md2 font-bold text-black">Admin Profile</h2>
            </div>
            <div
              class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
              
            </div>
          </div>
          <!-- ====== Settings Section Start -->
          <div class="grid grid-cols-5 gap-8">
            <div class="col-span-5 xl:col-span-3">
              <div
                class="rounded-sm border border-stroke bg-white shadow-default">
                <div class="border-b border-stroke py-4 px-7">
                  <h3 class="font-medium text-black">Personal Information</h3>
                </div>
                <div class="p-5">
                  <form action="submit">
                    <div class="mb-5.5 flex flex-col gap-5.5 sm:flex-row justify-between">
                      <div class="w-full mr-3 sm:w-1/2">
                        <label
                          class=" block text-sm font-medium text-black"
                          for="fullName"
                          >Full Name</label
                        >
                        <div class="relative py-3">
                          <input
                            class="w-full rounded bg-slate-300 border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none"
                            type="text"
                            name="fullName"
                            id="fullName"
                            placeholder="Enter your full name"
                            value="Deepayan Mukhopadhyay" />
                        </div>
                      </div>

                      <div class="w-full sm:w-1/2">
                        <label
                          class="mb-3 block text-sm font-medium text-black"
                          for="phoneNumber"
                          >Phone Number</label
                        >
                        <input
                          class="w-full rounded border border-stroke bg-gray py-3 px-4.5 font-medium bg-slate-300 text-black focus:border-primary focus-visible:outline-none"
                          type="text"
                          name="phoneNumber"
                          id="phoneNumber"
                          placeholder="Enter your phone number"
                          value="9330648828" />
                      </div>
                    </div>

                    <div class="mb-5.5">
                      <label
                        class="mb-3 block text-sm font-medium text-black"
                        for="emailAddress"
                        >Email Address</label
                      >
                      <div class="relative">
                        <input
                          class="w-full rounded border border-stroke bg-slate-300 py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none"
                          type="email"
                          name="emailAddress"
                          id="emailAddress"
                          placeholder="Enter your email"
                          value="mukhopadhyaydeepayan@gmail.com" />
                      </div>
                    </div>

                    <div class="flex justify-between gap-4.5 mt-3">
                      <button
                        class="flex justify-center rounded border border-stroke py-2 px-6 font-medium text-black hover:bg-blue-400"
                        type="button"
                        onclick="removeProfileModal()">
                        Close
                      </button>
                      <button
                        class="flex justify-center rounded border border-stroke py-2 px-6 font-medium text-black hover:bg-blue-400"
                        type="submit"
                       >
                        Save
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-span-5 xl:col-span-2">
              <div
                class="rounded-sm border border-stroke bg-white shadow-default">
                <div class="border-b border-stroke py-4 px-7">
                  <h3 class="font-medium text-black">Your Photo</h3>
                </div>
                <div class="p-7">
                  <form action="#">
                    <div class="mb-4 flex items-center gap-3">
                      <div class="h-14 w-14 rounded-full">
                        <img src="src/images/user/user-03.png" alt="User" />
                      </div>
                      <div>
                        <span class="mb-1.5 font-medium text-black"
                          >Edit your photo</span
                        >
                        <span class="flex gap-2.5">
                          <button
                            class="text-sm font-medium hover:text-primary">
                            Delete
                          </button>
                          <button
                            class="text-sm font-medium hover:text-primary" action="submit">
                            Update
                            
                          </button>
                        </span>
                      </div>
                    </div>

                    <div
                      id="FileUpload"
                      class="relative mb-5.5 block w-full cursor-pointer appearance-none rounded border-2 border-dashed border-primary bg-gray py-4 px-4">
                      <input
                        type="file"
                        accept="image/*"
                        class="absolute bg-slate-300 m-3 inset-0 z-50 m-0 h-full w-full cursor-pointer p-0 opacity-0 outline-none" />
                      <div
                        class="flex flex-col items-center justify-center space-y-3">
                        <p class="text-sm font-medium">
                          <span class="text-primary">Click to upload</span>
                          or drag and drop
                        </p>
                        <p class="mt-1.5 text-sm font-medium">
                          SVG, PNG, JPG or GIF
                        </p>
                        <p class="text-sm font-medium">(max, 800 X 800px)</p>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="script.js"></script>
  </body>
</html>
