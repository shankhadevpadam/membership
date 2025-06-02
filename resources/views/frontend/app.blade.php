<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Registration</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i"
        rel="stylesheet" />

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100 min-h-screen py-8 font-roboto">
    <div x-data="registerMember" class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="p-3 rounded-tl-md rounded-tr-md bg-blue-500">
            <div class="flex justify-between items-center">
                <h2 class="text-lg font-semibold text-white">Member Registration</h2>
            </div>
        </div>

        <!-- Main Form -->
        <div class="bg-white">
            <form @submit.prevent="submit">
                <!-- Basic Information -->
                <div class="p-6 border-b border-gray-200">
                    <h3 class="font-medium mb-4">Basic Information</h3>
                    <span x-text="name"></span>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">First Name*</label>
                            <input type="text" placeholder="First Name"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md" x-model="firstName"
                                required />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Last Name*</label>
                            <input type="text" placeholder="Last Name"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md" x-model="lastName"
                                required />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Gender*</label>
                            <select class="w-full px-3 py-[0.6rem] border border-gray-300 rounded-md" x-model="gender">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Mobile Number*</label>
                            <input type="tel" placeholder="Mobile number"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md" x-model="mobile" required />
                        </div>
                    </div>

                </div>

                <!-- Login Information -->
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-gray-700 font-medium mb-4">Login Information</h3>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email*</label>
                        <input type="email" placeholder="Email Address"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md" 
                            x-model="email" 
                            required />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Password*</label>
                            <div class="relative">
                                <input type="password" placeholder="Password"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md"
                                    x-model="password"
                                    required >
                                <button type="button" class="absolute right-2 top-2 text-red-500 hover:text-red-700">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Confirm Password*</label>
                            <div class="relative">
                                <input type="password" placeholder="Confirm Password"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md">
                                <button type="button" class="absolute right-2 top-2 text-red-500 hover:text-red-700">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Primary Address -->
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-gray-700 font-medium mb-4">Primary Address</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <input type="text" placeholder="Address Line 1"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md"
                                x-model="addressLine1"
                                required />
                        </div>
                        <div>
                            <input type="text" placeholder="Address Line 2"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md"
                                x-model="addressLine2" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-md" x-model="country">
                                <option>Australia</option>
                                <option>United States</option>
                                <option>Canada</option>
                                <option>United Kingdom</option>
                            </select>
                        </div>
                        <div>
                            <input type="text" placeholder="City"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md"
                                x-model="city" />
                        </div>
                        <div>
                            <input type="text" placeholder="State"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md"
                                x-model="state" />
                        </div>
                        <div class="relative">
                            <input type="text" placeholder="Zip"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md"
                                x-model="zip" />
                            <span class="absolute right-2 top-2 text-red-500">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Business Information -->
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-gray-700 font-medium mb-4">Business Information</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <input type="text" placeholder="Business Name"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md"
                                x-model="businessName" />
                        </div>
                        <div>
                            <input type="text" placeholder="ABN"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md"
                                x-model="abn" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <input type="url" placeholder="Website"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md"
                                x-model="website" />
                        </div>
                        <div>
                            <input type="tel" placeholder="Office Phone"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md"
                                x-model="officePhone" />
                        </div>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-gray-700 font-medium mb-4">Payment Method</h3>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Invoice Required*</label>
                        <div class="flex gap-6">
                            <label class="flex items-center">
                                <input type="radio" name="invoice" value="yes" class="mr-2 text-blue-600">
                                <span class="text-gray-700">Yes</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="invoice" value="no" class="mr-2 text-blue-600">
                                <span class="text-gray-700">No</span>
                            </label>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label
                                class="flex items-center p-4 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                <input type="radio" name="payment" value="cheque" class="mr-3 text-blue-600">
                                <span class="text-gray-700">Cheque/Money Order</span>
                            </label>
                        </div>

                        <div>
                            <label
                                class="flex items-center p-4 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                <input type="radio" name="payment" value="transfer" class="mr-3 text-blue-600">
                                <span class="text-gray-700">Direct Deposit /Internet Transfer</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Terms and Actions -->
                <div class="p-6">
                    <div class="mb-6">
                        <label class="flex items-start">
                            <input type="checkbox" class="mr-3 mt-1 text-blue-600">
                            <span class="text-sm text-gray-700">
                                I agree <a href="#" class="text-blue-600 hover:underline">terms and
                                    conditions</a>
                            </span>
                        </label>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <button type="submit"
                            class="flex-1 bg-blue-500 hover:bg-blue-600 text-white font-medium py-3 px-6 rounded-md transition-colors duration-200">
                            Register
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('registerMember', () => ({
                firstName: '',
                lastName: '',
                gender: 'male',
                mobile: '',
                email: '',
                password: '',
                addressLine1: '',
                addressLine2: '',
                country: '',
                city: '',
                state: '',
                zip: '',
                businessName: '',
                abn: '',
                website: '',
                officePhone: '',

                async submit() {

                },
            }))
        })
    </script>
</body>

</html>
