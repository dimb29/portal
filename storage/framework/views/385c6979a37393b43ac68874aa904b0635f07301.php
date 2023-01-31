

            <div class="p-6 -mx-9 sm:mx-0 -mt-12 sm:-mt-8">

                <div class="slider">

                    <?php $__currentLoopData = $trend; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $postrend): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <div data-mdb-ripple="true"
				data-mdb-ripple-color="light" class="max-w-sm h-auto sm:h-1/2 mx-0 sm:mx-0 rounded overflow-hidden shadow-xl hover:bg-gray-300 mt-12 m-8
                        rounded-lg hover:text-blue-600 transition duration-150 transform hover:scale-110 hover:-translate-y-2 ">
                                <a  href="<?php echo e(url('posts', $postrend->id)); ?>">
                        
                                    <?php if(count($postrend->images) != 0): ?>
                                        <?php $__currentLoopData = $postrend['images']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <img class="object-fit h-48 w-screen rounded-lg" src="<?php echo e(url($image->url)); ?>" alt="<?php echo e($image->description); ?>">
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                            <img class="object-fit h-48 w-screen rounded-lg" src="<?php echo e(url('storage/photos/default_jobs.png')); ?>" alt="this is default">
                                    <?php endif; ?>
                                    
                                    <!-- <div class="css-1f2quy8">
                                        <div class="responsive css-1eg7f6s">
                                            <span class="responsive css-10rucli"></span>
                                            <?php if($postrend->author->profile_photo_path != null): ?>
                                                <img class="css-1c345mg" src="<?php echo e(url($postrend->author->profile_photo_url)); ?>" alt="<?php echo e($postrend->author->first_name . ' ' . $postrend->author->last_name); ?>" />
                                            <?php else: ?>
                                                <img class="css-1c345mg" src="<?php echo e(url('storage/photos/default-logo.jpg')); ?>" alt="<?php echo e($postrend->author->first_name . ' ' . $postrend->author->last_name); ?>" />
                                            <?php endif; ?>
                                        </div>
                                    </div> -->
                                    <div class="p-0 sm:p-6">

                                        <div class="px-2 sm:p-0">
                                        <p class="w-full text-blue-900 text-base sm:text-lg"><?php echo e($postrend->title); ?></p>
                                        <h5 class="text-gray-900 text-xs sm:text-sm -ml-1 mb-4 font-semibold">
                                            <?php if($postrend->salary_check == 1): ?>
                                            Rp <?php echo e(number_format($postrend->salary_start,0,',','.').' - Rp '.number_format($postrend->salary_end,0,',','.')); ?>

                                            <?php endif; ?>
                                        </h5>
                                        <h5 class="textl text-gray-900 text-xs sm:text-base text-blue-600 font-medium">
                                            <?php echo e($postrend->author->first_name . ' ' . $postrend->author->last_name); ?>

                                        </h5>
                                        <?php
                                            $regens = $postrend->regency;
                                            $dists = $postrend->district;
                                            $count_loc = count($regens)+count($dists);
                                            $ri = 1;
                                        ?>
                                        <div class="relative mb-2 w-full" 
                                                x-data="{
                                                            active: 1,
                                                            loop() {
                                                                setInterval(() => { this.active = this.active === <?php echo e($count_loc); ?> ? 1 : this.active+1 }, <?php echo e($count_loc); ?>000)
                                                            },
                                                        }"
                                                x-init="loop">
                                            <div class="flex flex-row overflow-x-hidden relative text-gray-900 text-xs sm:text-base font-medium w-full">
                                                <?php if($regens != null): ?>
                                                    <?php $__currentLoopData = $postrend->regency; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $regen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div
                                                            class="textlcw-full"
                                                            x-show="active == <?php echo e($ri); ?>"
                                                            x-transition:enter="transition duration-1000"
                                                            x-transition:enter-start="transform translate-x-full"
                                                            x-transition:enter-end="transform translate-x-0"
                                                        >
                                                                <p class="w-full"><?php echo e($regen->name); ?></p>
                                                        </div>
                                                    <?php $ri= $ri+1 ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                                <?php if($dists != null): ?>
                                                    <?php $__currentLoopData = $dists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div
                                                            class="textl w-full"
                                                            x-show="active == <?php echo e($ri); ?>"
                                                            x-transition:enter="transition duration-1000"
                                                            x-transition:enter-start="transform translate-x-full"
                                                            x-transition:enter-end="transform translate-x-0"
                                                        >
                                                                <p class="w-full"><?php echo e($dist->name); ?></p>
                                                        </div>
                                                    <?php $ri= $ri+1 ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="font-medium text-xs sm:text-base text-gray-400 mb-2 mt-4">

                                        <p>
                                            <?php
                                            $minutes = $thistime->diffInMinutes($postrend->updated_at);
                                            $hours = $thistime->diffInHours($postrend->updated_at);
                                            $days = $thistime->diff($postrend->updated_at)->days;
                                            $weeks = $thistime->diffInWeeks($postrend->updated_at);
                                            $months = $thistime->diffInMonths($postrend->updated_at);
                                            $years = $thistime->diffInYears($postrend->updated_at);
                                            ?>
                                            <?php if($minutes <= 60): ?>
                                                <?php echo e($minutes); ?> menit yang lalu
                                            <?php elseif($hours <= 24): ?>
                                                <?php echo e($hours); ?> jam yang lalu
                                            <?php elseif($days <= 7): ?>
                                                <?php echo e($days); ?> hari yang lalu
                                            <?php elseif($weeks <= 4): ?>
                                                <?php echo e($weeks); ?> minggu yang lalu
                                            <?php elseif($months <= 12): ?>
                                                <?php echo e($months); ?> bulan yang lalu
                                            <?php else: ?>
                                                <?php echo e($years); ?> tahun yang lalu
                                            <?php endif; ?>

                                        </p>

                                        </div>
                                    
                                        </div>

                                    </div>

                                </a>

                            

                        </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>

            </div><?php /**PATH C:\Users\Masgasso\Documents\project\news\resources\views/livewire/dashboard/slider.blade.php ENDPATH**/ ?>