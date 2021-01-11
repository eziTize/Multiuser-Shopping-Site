<template>
    <nav>
        <div class="container mx-auto px-2 flex justify-around items-center">
             <div class="w-full">
                    <ul class="flex mb-0 list-none flex-wrap pt-3 pb-4">
                        <li class="mb-2 mr-2 last:mr-0 flex-auto text-center">
                            
                            <router-link tag="tab1" to="/" class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-blue-600 bg-white" exact>
                                Electric Fans
                            </router-link>
                        </li>
                        <li class="mb-2 mr-2 last:mr-0 flex-auto text-center">

                           <router-link tag="tab2" to="/category/sewing-machines" class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-blue-600 bg-white" exact>
                                Sewing Machines
                            </router-link>

                        </li>
                        <li class="mb-2 mr-2 last:mr-0 flex-auto text-center">
                             <router-link tag="tab3" to="/category/electric-lights" class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-blue-600 bg-white" exact>
                               Electric Lights
                            </router-link>
                        </li>
                        <li class="mb-2 mr-2 last:mr-0 flex-auto text-center">
                            <router-link tag="tab4" to="/category/home-appliances" class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-blue-600 bg-white" exact>
                                Home Appliances
                            </router-link>
                        </li>
                    </ul>

                 <!---
                    <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
                        <div class="px-4 py-5 flex-auto">
                            <div class="tab-content tab-space">
                                <div v-bind:class="{'hidden': openTab !== 1, 'block': openTab === 1}">
                                    <p>
                                        Collaboratively administrate empowered markets via
                                        plug-and-play networks. Dynamically procrastinate B2C users
                                        after installed base benefits.
                                        <br />
                                        <br />
                                        Dramatically visualize customer directed convergence
                                        without revolutionary ROI.
                                    </p>
                                </div>
                                <div v-bind:class="{'hidden': openTab !== 2, 'block': openTab === 2}">
                                    <p>
                                        Completely synergize resource taxing relationships via
                                        premier niche markets. Professionally cultivate one-to-one
                                        customer service with robust ideas.
                                        <br />
                                        <br />
                                        Dynamically innovate resource-leveling customer service for
                                        state of the art customer service.
                                    </p>
                                </div>
                                <div v-bind:class="{'hidden': openTab !== 3, 'block': openTab === 3}">
                                    <p>
                                        Efficiently unleash cross-media information without
                                        cross-media value. Quickly maximize timely deliverables for
                                        real-time schemas.
                                        <br />
                                        <br />
                                        Dramatically maintain clicks-and-mortar solutions
                                        without functional solutions.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    -->
             </div>
        </div>
    </nav>
</template>

<script>
    export default {

    }
</script>

<style scoped>
tab1.router-link-exact-active {
 @apply text-white bg-blue-600;
}

tab2.router-link-exact-active {
 @apply text-white bg-gray-600;
}

tab3.router-link-exact-active {
 @apply text-white bg-yellow-600;
}

tab4.router-link-exact-active {
 @apply text-white bg-green-600;
}
</style>