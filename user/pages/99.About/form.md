---
title: forms
forms:
    name: donebutton
        fields:
            - name: done
              type: toggle
              label: done
              highlight: 1
              options:
                1: done.YES
                0: done.NO
              validate:
                type: bool