<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerBuhQRPV\srcApp_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerBuhQRPV/srcApp_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerBuhQRPV.legacy');

    return;
}

if (!\class_exists(srcApp_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerBuhQRPV\srcApp_KernelDevDebugContainer::class, srcApp_KernelDevDebugContainer::class, false);
}

return new \ContainerBuhQRPV\srcApp_KernelDevDebugContainer([
    'container.build_hash' => 'BuhQRPV',
    'container.build_id' => '1d7b7e90',
    'container.build_time' => 1564058243,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerBuhQRPV');
