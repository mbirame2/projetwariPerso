<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerNw93EUH\srcApp_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerNw93EUH/srcApp_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerNw93EUH.legacy');

    return;
}

if (!\class_exists(srcApp_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerNw93EUH\srcApp_KernelDevDebugContainer::class, srcApp_KernelDevDebugContainer::class, false);
}

return new \ContainerNw93EUH\srcApp_KernelDevDebugContainer([
    'container.build_hash' => 'Nw93EUH',
    'container.build_id' => 'be02e673',
    'container.build_time' => 1564653110,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerNw93EUH');
