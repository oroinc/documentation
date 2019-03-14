.. _dev-cookbook-system-cron-create-commands:

Create Scheduled Commands in OroPlatform
========================================

A scheduled command in OroPlatform is a regular Symfony console command that implements additional `CronCommandInterface <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/CronBundle/Command/CronCommandInterface.php>`__ and has the **oro:cron** namespace.

Implementing *CronCommandInterface* requires the implementation of the
`getDefaultDefinition() <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/CronBundle/Command/CronCommandInterface.php#L14>`__ method. It returns the `crontab compatible <http://www.unix.com/man-page/linux/5/crontab/>`_ description of when the command should be executed. For example, if a command should run every day five minutes after midnight, the appropriate
value is **5 0 \* \* \***.

.. code-block:: php
    :linenos:

    // src/Acme/DemoBundle/Command/DemoCommand.php
    namespace Acme\DemoBundle\Command;

    use Oro\Bundle\CronBundle\Command\CronCommandInterface;
    use Symfony\Component\Console\Input\InputInterface;
    use Symfony\Component\Console\Output\OutputInterface;

    class DemoCommand implements CronCommandInterface
    {
        public function getDefaultDefinition()
        {
            return '5 0 * * *';
        }


        protected function configure()
        {
            $this->setName('oro:cron:demo');

            // ...
        }

        protected function execute(InputInterface $input, OutputInterface $output)
        {
            // ...
        }
    }

Synchronous Cron Commands
-------------------------

By default, **all Cron commands are executed asynchronously** by sending a message to the queue.

Sometimes it is necessary to execute a Cron command **immediately** when Cron triggers it, without sending the message
to the queue.

To do this, a Cron command should implement the
`SynchronousCommandInterface <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/CronBundle/Command/SynchronousCommandInterface.php>`_ interface. In this case, the command will be executed as a background process.

.. note:: Please note that the synchronous commands must be designed well-performed and should not block process execution as it may affect scheduled execution of other commands.

Schedule Cron Commands in DB
----------------------------

After creating the Cron commands classes, run the **oro:cron:definitions:load** command to schedule the created
command in the DB. After that, the Cron command will be ready to evaluate and execute it during the next **oro:cron** command tick.